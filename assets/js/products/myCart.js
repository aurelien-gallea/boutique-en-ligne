import { key } from "../modules/key.js";

fetch(`${key}checkMyCart.php`)
  .then((response) => response.json())
  .then((data) => console.log(data));
