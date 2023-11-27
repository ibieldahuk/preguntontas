function editarRespuesta(idPregunta, idElemento, idRespuesta, esCorrecta) {
    let contenedor = document.getElementById(idElemento);
    let respuesta = contenedor.querySelector("p").textContent;
    let codigo = "<form action=\"/editor/editarRespuesta\" method=\"post\">\n" +
        "<input type=\"hidden\" name=\"id-pregunta\" value=\"" + idPregunta + "\">\n" +
        "<input type=\"hidden\" name=\"id-respuesta\" value=\"" + idRespuesta + "\">\n" +
        "<input type=\"hidden\" name=\"es-correcta\" value=\"" + esCorrecta + "\">\n" +
        "<input type=\"text\" class=\"form-control\" name=\"opcion\" value=\"" + respuesta + "\">\n" +
        "<button type=\"submit\" class=\"btn btn-primary\">Confirmar</button>\n" +
        "<button class=\"btn btn-primary\" onclick=\"cancelarEdicion(\'" + idPregunta + "\',\'" + idElemento + "\',\'" + idRespuesta + "\',\'" + esCorrecta + "\',\'" + respuesta + "\')\">Cancelar</button>\n" +
        "</form>\n";
    contenedor.innerHTML = codigo;
}

function cancelarEdicion(idPregunta, idElemento, idRespuesta, esCorrecta, respuesta) {
    let contenedor = document.getElementById(idElemento);
    let codigo = "<p>" + respuesta + "</p>" +
        "<button onclick=\"editarRespuesta(\'" + idPregunta + "\',\'" + idElemento + "\',\'" + idRespuesta + "\',\'" + esCorrecta + "\')\" class=\"btn btn-primary\">Editar</button>";
    contenedor.innerHTML = codigo;
}

function editarPregunta(idPregunta) {
    let contenedor = document.getElementById("pregunta");
    let pregunta = contenedor.querySelector("p").textContent;
    let codigo = "<form action=\"/editor/editarPregunta\" method=\"post\">\n" +
        "<input type=\"hidden\" name=\"id\" value=\"" + idPregunta + "\">\n" +
        "<input type=\"text\" class=\"form-control\" name=\"pregunta\" value=\"" + pregunta + "\">\n" +
        "<button type=\"submit\" class=\"btn btn-primary\">Confirmar</button>\n" +
        "<button class=\"btn btn-primary\" onclick=\"cancelarEdicionPregunta(\'" + idPregunta + "\',\'" + pregunta + "\')\">Cancelar</button>\n" +
        "</form>\n";
    contenedor.innerHTML = codigo;
}

function cancelarEdicionPregunta(idPregunta, pregunta) {
    let contenedor = document.getElementById("pregunta");
    let codigo = "<p>" + pregunta + "</p>" +
        "<button onclick=\"editarPregunta(\'" + idPregunta + "\')\" class=\"btn btn-primary\">Editar</button>";
    contenedor.innerHTML = codigo;
}
