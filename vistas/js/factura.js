    $(document).ready(function() {
                
  
            miFuncion(25);
    
    });


    function miFuncion(number) {
                var numero = "0000000"+ number;
                //var numero = document.getElementById("valor").value;
                document.getElementById("imagen").innerHTML = '<img src="generar.php?numero='+numero+'">';
                document.getElementById('Ingreso').style.display = 'none';
            }


    function fechaActual(){ 
        let fecha = new Date(); 
        
        let day = fecha.getDate();
        
        let month = fecha.getMonth() +1;
        
        if ((day >= 0)&&(day <= 9)){ 
            day="0"+day; 
        }
        
        if ((month >= 0)&&(month <= 9)){ 
            month="0"+month; 
        }
    
        let  fechaActual1 = fecha.getFullYear() + "-" + month + "-" + day;

        return fechaActual1;

    }