const tg = TangleGlumb(document.getElementById("graph"), {
  CIRCLE_SIZE: 60,
  PIN_OLD_NODES: false,
  STATIC_FRONT: false,
  TITLE: ""
});

const transformTx = input => {
  const transformed = {
    hash: input.hash,
    address: input.address,
    value: input.value,
    timestamp: input.receivedAt,
    bundle_hash: input.bundle,
    transaction_branch: input.branch,
    transaction_trunk: input.trunk,
    milestone: input.milestone === "f" ? false : true,
    tag: input.tag
  };
  return transformed;
};

const tanglegraphMain = () => {
  if (typeof tangle === "undefined")
    tangle = new tangleview({
      host: window.location.hostname,
      ssl: false,
      amount: 8000
    });

  console.log(
    "tanglegraph debug (window.location.hostname)",
    window.location.hostname
  );

  tangle
    .getTxHistory({ amount: 8000 })
    .then(history => {
      //console.log("Tangle history:", history);
      history.map(tx => {
        const transformedTx = transformTx(tx);
        tg.updateTx([transformedTx]);
      });
    })
    .catch(err => {
      console.log("Error fetching Tangle history:", err);
    });

  tangle.on("txNew", newTx => {
    const transformedTx = transformTx(newTx);
    tg.updateTx([transformedTx]);
  });
};

tanglegraphMain();
