export function initDetalle() {
  console.log("Detalle cargado correctamente");

  const btnVolver = document.querySelector('button.volver');

  btnVolver?.addEventListener('click', () => {
    history.back();  // O podés recargar trazabilidad directamente
  });
}
