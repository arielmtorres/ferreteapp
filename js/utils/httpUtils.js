
export async function httpMethod(url, method, body){
    
    if (body != null)
        body = JSON.stringify(body);

    const ret = await fetch(url, {
        method: method,
        body: body,
        headers: {"Content-type": "application/json; charset=UTF-8"}
    });
    
    const response = await ret.json();

    console.log(response);

    return response;

}

/*
export async function loadComponent(componentPath, targetId, callback) {
  try {
    const res = await fetch(componentPath);
    const html = await res.text();
    document.getElementById(targetId).innerHTML = html;
    if (callback) callback();
  } catch (error) {
    console.error(`Error cargando ${componentPath}:`, error);
  }
}

export function activarSidebarHover() {
  const buttons = document.querySelectorAll('.sidebar-button');
  buttons.forEach(button => {
    button.addEventListener('click', function () {
      buttons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
    });
  });
}


*/