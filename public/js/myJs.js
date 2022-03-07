function toast(data=[]){
    
    let icon = (data.icon)?data.icon:'success';
    let position = (data.position)?data.position:'center';
    let timer = (data.timer)?data.timer:1500;
    let title = (data.title)?data.title:'Texto de prueba';
    Swal.fire({
        position: position,
        icon: icon,
        title: title,
        showConfirmButton: false,
      timer: timer
    })
 }

 window.addEventListener('toast', event => {
  let icon = (event.detail.icon)?event.detail.icon:'success';
  let position = (event.detail.position)?event.detail.position:'center';
  let timer = (event.detail.timer)?event.detail.timer:1500;
  let title = (event.detail.title)?event.detail.title:'Texto de prueba';
   toast({
    title:title,
    icon:icon,
    position:position,
    timer:timer,
    });
})
 window.addEventListener('consolelog', event => {
  let c1 = (event.detail.consolelog)? event.detail.consolelog:'consolelog vacio';
  
  if (event.detail.consolelog2) {
    console.log(c1,event.detail.consolelog2);
  }else{
    console.log(c1);
  }
   
})

  function number_format(x){
    return Math.round(x).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }


// alert('holas');


      