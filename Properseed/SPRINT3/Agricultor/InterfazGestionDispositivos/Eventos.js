const btns_consultar_rango = document.querySelectorAll(".Tabla_dispositivos .btn_tabla_consultar_rango");
const btns_ubicacion = document.querySelectorAll(".Tabla_dispositivos .btn_tabla_ubicacion");

const formulario_consultar_rango = document.getElementById("formulario_consultar_rango");
const formulario_ubicacion = document.getElementById("formulario_ubicacion");

const input_id_consultar_rango = document.getElementById("id_consultar_rango");
const input_id_ubicacion = document.getElementById("id_ubicacion");

function consultarRango(){
	let id = this.parentNode.parentNode.getElementsByTagName("td")[0].innerHTML;
	input_id_consultar_rango.value = id;
	formulario_consultar_rango.submit();
}
function ubicacion(){
	let id = this.parentNode.parentNode.getElementsByTagName("td")[0].innerHTML;
	input_id_ubicacion.value = id;
	formulario_ubicacion.submit();
}


btns_consultar_rango.forEach(btn_consulta_rango => {
	btn_consulta_rango.addEventListener("click", consultarRango);
});

btns_ubicacion.forEach(btn_ubicacion => {
	btn_ubicacion.addEventListener("click", ubicacion);
});