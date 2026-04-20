import "./bootstrap";

import Alpine from "alpinejs";

import Quill from "quill";
import "quill/dist/quill.snow.css";
import ImageResize from "quill-image-resize-module-react";

Quill.register("modules/imageResize", ImageResize);
window.Quill = Quill;

window.Alpine = Alpine;

Alpine.start();
