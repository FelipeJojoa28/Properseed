const btns_consultar = document.querySelectorAll(".Tabla_usuarios .btn_tabla_consultar");
const btns_modificar = document.querySelectorAll(".Tabla_usuarios .btn_tabla_modificar");

const formulario_consultar = document.getElementById("formulario_consultar_usuario");
const formulario_modificar = document.getElementById("formulario_modificar_usuario");

const input_id_consultar = document.getElementById("id_consultar_usuario");
const input_id_modificar = document.getElementById("id_modificar_usuario");

function consultar(){
	let id = this.parentNode.parentNode.getElementsByTagName("td")[0].innerHTML;
	input_id_consultar.value = id;
	formulario_consultar.submit();
}
function modificar(){
	let id = this.parentNode.parentNode.getElementsByTagName("td")[0].innerHTML;
	input_id_modificar.value = id;
	formulario_modificar.submit();
}

btns_consultar.forEach(btn_consulta => {
	btn_consulta.addEventListener("click", consultar);
});
btns_modificar.forEach(btn_modifica => {
	btn_modifica.addEventListener("click", modificar);
});