"use strict";

{
  const manufactuer_selector = document.getElementById("manufacturer_id");
  const model_selector = document.getElementById("model_id");

  const populate_model_selector = () => {
    for (const [model_id, model] of Object.entries(models)) {
      if (manufacturers[model.manufacturer] === manufactuer_selector.value) {
        const opt = document.createElement("option");
        opt.value = model_id;
        opt.textContent = model.name;
        if (current_model === model.manufacturer + ' | ' + model.name) {
          opt.selected = true;
        }
        model_selector.appendChild(opt);
      }
    }
  };

  populate_model_selector();
  manufactuer_selector.addEventListener('change', ev => {
    model_selector.innerHTML = "";
    populate_model_selector();
  });
}
