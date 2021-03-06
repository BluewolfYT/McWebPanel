/*
This file is part of McWebPanel.
Copyright (C) 2020 Cristina Ibañez, Konata400

    McWebPanel is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    McWebPanel is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with McWebPanel.  If not, see <https://www.gnu.org/licenses/>.
*/

$(function() {

    $("#elpass").keyup(function() {
        var getpass = document.getElementById("elpass").value;
        if (getpass == "") {
            document.getElementById("textoretorno").innerHTML = "";
        } else {
            $.ajax({
                url: 'function/compass.php',
                data: {
                    action: getpass
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    if (data.error == 1) {
                        document.getElementById("textoretorno").innerHTML = data.texto;
                        document.getElementById("btcrearusuario").disabled = true;
                    } else {
                        document.getElementById("textoretorno").innerHTML = "";
                        document.getElementById("btcrearusuario").disabled = false;
                    }
                }
            });
        }
    });

    $("#form-createuser").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "function/gestusereditarusuario.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data == "nohayusuario") {
                    alert("No se ha recibido ningún usuario");
                } else if (data == "passwordsdiferentes") {
                    alert("Las contraseñas introducidas son diferentes");
                } else if (data == "nocumplereq") {
                    alert("La contraseña no cumple los requisitos");
                } else if (data == "errarchnoconfig") {
                    alert("Carpeta Config no existe");
                } else if (data == "errconfignoread") {
                    alert("Carpeta Config no tiene permisos de lectura");
                } else if (data == "errconfignowrite") {
                    alert("Carpeta Config no tiene permisos de escritura");
                } else if (data == "errjsonnoexist") {
                    alert("El archivo de usuarios no existe");
                } else if (data == "errjsonnoread") {
                    alert("El archivo de usuarios no tiene permisos de lectura");
                } else if (data == "errjsonnowrite") {
                    alert("El archivo de usuarios no tiene permisos de escritura");
                } else if (data == "OK") {
                    alert("Para que se apliquen los cambios el usuario editado tiene que cerrar sesión");
                    location.href = "gestorusers.php";
                }

            },
            error: function() {
                alert("error");
            }
        });
    }));

    function sessionTimer() {

        $.ajax({
            url: 'function/salirsession.php',
            data: {
                action: 'status'
            },
            type: 'POST',
            success: function(data) {
                if (data == "SALIR") {
                    location.href = "index.php";
                }


            }
        });
    }

    setInterval(sessionTimer, 1000);

});