"use strict";

{
  const manufacturer_selector = document.getElementById("manufacturer_id");
  for (const [manufacturer, manufacturer_id] of Object.entries(manufacturers)) {
    const opt = document.createElement("option");
    opt.textContent = manufacturer;
    opt.value = manufacturer_id;
    for (const [model_id, model] of Object.entries(models)) {
      if (current_model === manufacturer + " | " + model.name) {
        opt.selected = true;
        break;
      }
    }
    manufacturer_selector.appendChild(opt);
  }
}
