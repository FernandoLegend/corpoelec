function cambiarEstilo() {
  const linkEstilo = document.getElementById('mi-estilo');
  if (linkEstilo.href.includes('claro.css')) {
    linkEstilo.href = './css/oscuro.css';
    
    document.cookie = "tema=oscuro";
  } else {
    linkEstilo.href = './css/claro.css';
    
    document.cookie = "tema=claro";
  }
}