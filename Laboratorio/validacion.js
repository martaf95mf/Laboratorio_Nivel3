function validacion (){

    // Variables nombre, apellido1, apellido2, email, login, password y confirmación password
    var elements = document.querySelectorAll("input");
    
    // Inicializamos las variables
    var valid_elements = [];


    elements.forEach(element => {
        
        // Error si campo vacío
        var required_text = document.createElement("p");
        required_text.appendChild(document.createTextNode("Rellene este campo"));
        required_text.style.color = "red";

        // create validation error message in red
        var error_text = document.createElement('p');
        if (element.type === "text") {
            var validation_msg = "No puede contener números ni símbolos"
        }
        else if ( element.type === "email" ) {
            var validation_msg = "Email inválido"
        }
        else if (element.type === "password") {
            if (element.name === "password" ) {
                var validation_msg = "Debe tener entre 4 y 8 caracteres"
            }
            else if (element.name === "confirm") {
                var validation_msg = "Las contraseñas no coinciden"
            }
        }
        error_text.appendChild(document.createTextNode(validation_msg));
        error_text.style.color = "red";

        const isEmpty = str => !str.trim().length;
        element.addEventListener("input", function() {
            if ( isEmpty(this.value) ) {
                if (document.body.contains(error_text)){
                    element.parentNode.removeChild(error_text);
                }

                element.parentNode.appendChild(required_text, element);

                element.style.border = "2px solid red";  
            }
            else {
                
                if (document.body.contains(required_text)){
                    element.parentNode.removeChild(required_text);
                }
          
                if ( element.name === "confirm" ) {
                    condition = (document.getElementById('password').value !== element.value);
                }
                else {
                    condition = (element.checkValidity() === false);
                }

                if ( condition ) {
                    element.parentNode.appendChild(error_text, element);

                    element.style.border = "2px solid red";
                    
                    const index = valid_elements.indexOf(element.name);
                    if (index > -1) { 
                        valid_elements.splice(index, 1); 
                    }
                }
                else {
                    if (document.body.contains(error_text)){
                        element.parentNode.removeChild(error_text);
                    }
                    
                    element.style.border = "2px solid green";
                    
                    if ( !valid_elements.includes(element.name) ){
                        valid_elements.push(element.name)
                    }
                }
            }
        });

    });

    document.getElementById('submit-button').addEventListener("click", function(event){

        const all_elements = ["nombre", "apellido1", "apellido2", "email", "login" ,"password", "confirm"]
        if ( all_elements.every(field => valid_elements.includes(field)) ) {
            alert("La inscripción se ha realizado con éxito.");
            return true;
        }
        else {
            alert("Uno o más campos no son válidos, por favor revíselos.");
            event.preventDefault();
            return false;
        }
    });

}

window.onload = validation;