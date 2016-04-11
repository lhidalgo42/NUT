function Rut(Valor) {
    var tmpstr = "";
    var intlargo = Valor
    if (intlargo.length > 0) {
        crut = Valor
        largo = crut.length;
        if (largo < 2) {
            return false;
        }
        for (i = 0; i < crut.length; i++)
            if (crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-') {
                tmpstr = tmpstr + crut.charAt(i);
            }
        rut = tmpstr;
        crut = tmpstr;
        largo = crut.length;

        if (largo > 2)
            rut = crut.substring(0, largo - 1);
        else
            rut = crut.charAt(0);

        dv = crut.charAt(largo - 1);

        if (rut == null || dv == null)
            return 0;

        var dvr = '0';
        suma = 0;
        mul = 2;

        for (i = rut.length - 1; i >= 0; i--) {
            suma = suma + rut.charAt(i) * mul;
            if (mul == 7)
                mul = 2;
            else
                mul++;
        }

        res = suma % 11;
        if (res == 1)
            dvr = 'k';
        else if (res == 0)
            dvr = '0';
        else {
            dvi = 11 - res;
            dvr = dvi + "";
        }
        if (dvr != dv.toLowerCase()) {
            return false;
        }
        //alert('El Rut Ingresado es Correcto!')
        return true;
    }
}
function validaPatient(rut) {
    var rut2;
    var bloob = true;
    var table = $('#dtes').DataTable();
    rut = rut.split(".").join("").split("-").join("").split(",").join("");
    console.log('rut : '+rut);
    table.data().each( function (d) {
        rut2 = d[0].split(".").join("").split("-").join("").split(",").join("");
        if(rut2 != "") {
            if (rut == rut2) {
                bloob = false;
            }
        }
    });
    return bloob;
}


function validaTerapist(rut) {
    var rut2;
    var bloob = true;
    var table = $('#dtes').DataTable();
    rut = rut.split(".").join("").split("-").join("").split(",").join("");
    console.log('rut : '+rut);
    table.data().each( function (d) {
        rut2 = d[0].split(".").join("").split("-").join("").split(",").join("");
        if(rut2 != "") {
            if (rut == rut2) {
                bloob = false;
            }
        }
    });
    return bloob;
}