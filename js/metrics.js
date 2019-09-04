// Config
const time = Date.now();
const timeframeOfHistory = 12 * 60 * 60;
const timeStep = "5m";

// Queries
let queries = [
  {
    order: 0,
    query: encodeURIComponent("rate(tanglebeat_tx_counter_compound[5m])"),
    label: "TPS (5min average)",
    type: "line"
  },
  {
    order: 1,
    query: encodeURIComponent("rate(tanglebeat_ctx_counter_compound[5m])"),
    label: "CTPS (5min average)",
    type: "line"
  },
  {
    order: 2,
    query: encodeURIComponent(
      "100 * rate(tanglebeat_ctx_counter_compound[5m]) / rate(tanglebeat_tx_counter_compound[5m])"
    ),
    label: "Conf Ratio (5min average)",
    type: "line"
  },
  {
    order: 3,
    query: encodeURIComponent("tanglebeat_latency_confirm_avg"),
    label: "tanglebeat_latency_confirm_avg",
    type: "line"
  },
  {
    order: 4,
    query: encodeURIComponent(
      "clamp_max(sum(increase(tanglebeat_confirmation_duration_counter[10m]))/sum(increase(tanglebeat_confirmation_counter[10m])), 1200)" // 1200 relevant for 10m / 30m ?
    ),
    label: "Conf time (Seconds, 10min average)",
    type: "line"
  },
  {
    order: 5,
    query: encodeURIComponent("tanglebeat:confirmation_metrics:tfph_adjusted"),
    label: "TfPH / Transfers per Hour",
    type: "line"
  },
  {
    order: 6,
    query: encodeURIComponent(
      "sum(increase(tanglebeat_pow_cost_counter[1h]))/sum(increase(tanglebeat_confirmation_counter[1h]))"
    ),
    label: "PoW cost",
    type: "line"
  },
  {
    order: 7,
    query: encodeURIComponent("sum(rate(tanglebeat_pow_cost_counter[30m]))"),
    label: "Contribution to TPS 1h",
    type: "line"
  },
  {
    order: 8,
    query: encodeURIComponent(
      "avg(rate(tanglebeat_confirmation_duration_counter[5m])/rate(tanglebeat_confirmation_counter[5m]))/60"
    ),
    label: "Confirmation time distribution",
    type: "bar"
  }
];

// Helper functions
const transformDataset = input => {
  if (input.length > 0) {
    const output = input.reduce((accumulator, currentValue) => {
      accumulator.push({
        t: parseInt(currentValue[0], 10) * 1000,
        y: parseInt(currentValue[1])
      });
      return accumulator;
    }, []);

    return output;
  } else {
    return false;
  }
};

const createCanvas = (createCanvas, iter) => {
  const canv = document.createElement("canvas");
  const div = document.createElement("div");

  canv.id = `chart${iter}`;
  div.appendChild(canv);
  div.classList.add("charts");
  createCanvas.appendChild(div);

  return document.getElementById(canv.id);
};

const fetchChartData = query => {
  return new Promise((resolve, reject) => {
    fetch(
      `http://tangleview.io:9090/api/v1/query_range?query=${query}&start=${time /
        1000 -
        timeframeOfHistory}&end=${time / 1000}&step=${timeStep}`
    )
      .then(response => response.json())
      .then(data => {
        const chartData = transformDataset(
          data && data.data && data.data.result[0]
            ? data.data.result[0].values
            : []
        );
        if (chartData) {
          resolve(chartData);
        } else {
          reject(`Chart data not present: ${query}`);
        }
      })
      .catch(err => {
        reject(err);
      });
  });
};

const createChart = (chartData, query) => {
  const ctx = document.getElementById(`chart${query.order}`);

  var myChart = new Chart(ctx, {
    type: `${query.type}`,
    data: {
      datasets: [
        {
          label: `${query.label}`,
          data: chartData,
          borderWidth: 1,
          showLine: true,
          steppedLine: false
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: false,

      scales: {
        xAxes: [
          {
            type: "time",
            distribution: "series"
          }
        ]
      }
    }
  });
};

const renderCharts = (chartElement, options) => {
  queries.map((query, iter) => {
    if (options.init) createCanvas(chartElement, iter);

    fetchChartData(query.query)
      .then(chartData => {
        createChart(chartData, query);
      })
      .catch(err => {
        console.log(err);
      });
  });
  window.setTimeout(() => {
    renderCharts(chartElement, { init: false });
  }, 10000);
};

const chartElement = document.getElementById("charts");
if (chartElement) renderCharts(chartElement, { init: true });
