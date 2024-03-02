"use strict";

const el_manufacturers = document.getElementById("manufacturers");
const el_models = document.getElementById("models");

let current_model = null;

const create_car_card = (model_id, model) => {
  const div = document.createElement("div");
  div.classList.add("car-card");

  const img = document.createElement("img");
  img.classList.add("car-card__img");
  img.src =
    "/static/cars/" +
    model.manufacturer +
    "-" +
    model.name.replace(" ", "-") +
    ".jpg";

  const label = document.createElement("p");
  label.classList.add("car-card__label");
  label.textContent = model.name;

  div.onclick = () => {
    populate_jobs(model);
  };

  div.appendChild(img);
  div.appendChild(label);
  return div;
};

const populate_models = (manufacturer) => {
  el_models.innerHTML = "";

  const selected_models = {};
  for (const [model_id, model] of Object.entries(models)) {
    if (model.manufacturer === manufacturer) {
      selected_models[model_id] = model;
    }
  }
  current_model = selected_models[Object.keys(selected_models)[0]];

  for (const [model_id, model] of Object.entries(selected_models)) {
    const card = create_car_card(model_id, model);
    el_models.appendChild(card);
  }

  populate_jobs(current_model);
};

const populate_jobs = (model) => {
  const body = document.getElementById("jobs-body");
  body.innerHTML = "";

  for (const [job_id, job] of Object.entries(jobs)) {
    for (const [_, job_price] of Object.entries(job_prices)) {
      if (
        job_price.model === model.manufacturer + " | " + model.name &&
        job_price.job === job.name
      ) {
        const row = document.createElement("tr");

        const name = document.createElement("td");
        name.textContent = job.name;
        row.appendChild(name);

        const description = document.createElement("td");
        description.textContent = job.description;
        row.appendChild(description);

        const price = document.createElement("td");
        price.textContent = job_price.price;
        row.classList.add("row");
        row.appendChild(price);

        row.onclick = () => {
          create_order(
            job_id,
            Object.keys(models).find((k) => models[k] === model),
          );
        };

        body.appendChild(row);
      }
    }
  }
};

const create_order = (job_id, model_id) => {
  if (!is_user) {
    window.location = "/controller/login.php";
  }
  const form = document.createElement("form");
  document.body.appendChild(form);
  form.method = "post";
  form.action = "/controller/new_order.php";

  const job = document.createElement("input");
  job.type = "hidden";
  job.name = "job_id";
  job.value = job_id;
  form.appendChild(job);

  const model = document.createElement("input");
  model.type = "hidden";
  model.name = "model_id";
  model.value = model_id;
  form.appendChild(model);

  form.submit();
};

const default_manufacturer = Object.keys(manufacturers)[0];
for (const [name, id] of Object.entries(manufacturers)) {
  const btn = document.createElement("button");
  btn.textContent = name;
  btn.onclick = () => {
    populate_models(name);
  };
  el_manufacturers.appendChild(btn);
}

populate_models(default_manufacturer);
populate_jobs(current_model);
