"use strict";

{
  const manufacturer_selector = document.getElementById("manufacturer_id");
  const model_selector = document.getElementById("model_id");
  const job_selector = document.getElementById("job_id");

  const populate_job_selector = () => {
    job_selector.innerHTML = "";
    const model = models[model_selector.value];

    for (const [_, job_price] of Object.entries(job_prices)) {
      if (model.manufacturer + " | " + model.name === job_price.model) {
        for (const [job_id, job_name] of Object.entries(jobs)) {
          if (job_name === job_price.job) {
            const opt = document.createElement("option");
            opt.value = job_id;
            opt.textContent = job_name;
            if (job_name === current_job) {
              opt.selected = true;
            }
            job_selector.appendChild(opt);
          }
        }
      }
    }
  };

  populate_job_selector();
  manufacturer_selector.addEventListener("change", (ev) => {
    populate_job_selector();
  });
  model_selector.addEventListener("change", (ev) => {
    populate_job_selector();
  });
}
