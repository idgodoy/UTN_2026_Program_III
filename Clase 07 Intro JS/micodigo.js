 function mostraralerta(){ 
      alert('hizo clic!'); 
    } 
    function hacerclic(){ 
      document.getElementsByTagName('p')[0].onclick=mostraralerta; 
    } 
    window.onload=hacerclic; 