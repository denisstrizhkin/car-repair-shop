"use strict";

{
  const manufacturer_selector = document.getElementById("manufacturer_id");
  const model_selector = document.getElementById("model_id");
  const job_selector = document.getElementById("job_id");

  const price = document.getElementById("price");
  const update_price = () => {
    price.value = null;

    const model = models[model_selector.value];
    const job = jobs[job_selector.value];

    const key = job + " | " + model.manufacturer + " | " + model.name;
    for (const [job_price_id, job_price] of Object.entries(job_prices)) {
      const a = job + " | " + model.manufacturer + " | " + model.name;
      const b = job_price.job + " | " + job_price.model;
      if (a === b) {
        price.value = job_price.price;
      }
    }
  };

  update_price();
  manufacturer_selector.addEventListener("change", (ev) => {
    update_price();
  });
  model_selector.addEventListener("change", (ev) => {
    update_price();
  });
  job_selector.addEventListener("change", (ev) => {
    update_price();
  });
}
