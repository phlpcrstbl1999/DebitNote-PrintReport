      
       $("#exportBy").change(function (event) {
        event.preventDefault();
        var dateRange = document.getElementById("dateRange"); 
            var fromDate = document.getElementById("fromDate");
            var toDate = document.getElementById("toDate");
        var dnRange = document.getElementById("dnRange");
            var fromDN = document.getElementById("fromDN");
            var toDN = document.getElementById("toDN");
        var nameRange = document.getElementById("nameRange");
            var nameReport = document.getElementById("nameReport");
        var particularsRange = document.getElementById("particularsRange");
            var particularsReport = document.getElementById("particularsReport");
        var e = document.getElementById("exportBy");
        var text = e.options[e.selectedIndex].value;
        if(text == "date") {
            dateRange.style.display = "block";
            dnRange.style.display = "none";
            nameRange.style.display = "none";
            particularsRange.style.display = "none";
            fromDN.value = "";
            toDN.value = "";
            nameReport.value = "";
            particularsReport.value = "";
            fromDN.removeAttribute("required");
            toDN.removeAttribute("required");
            nameReport.removeAttribute("required");
            particularsReport.removeAttribute("required");
          
            fromDate.setAttribute("required", "");
            toDate.setAttribute("required", "");


        }
        else if(text == "dnNumber"){
            dnRange.style.display = "block";
            dateRange.style.display = "none";
            nameRange.style.display = "none";
            particularsRange.style.display = "none";
            nameReport.value = "";
            particularsReport.value = "";
            fromDate.value = "";
            toDate.value = "";
            fromDate.removeAttribute("required");
            toDate.removeAttribute("required");
            nameReport.removeAttribute("required");
            particularsReport.removeAttribute("required");

            fromDN.setAttribute("required", "");
            toDN.setAttribute("required", "");
        } else if(text == "name"){
            nameRange.style.display = "block";
            dateRange.style.display = "none";
            dnRange.style.display = "none";
            particularsRange.style.display = "none";
            particularsReport.value = "";
            fromDate.value = "";
            toDate.value = "";
            fromDN.value = "";
            toDN.value = "";
            fromDate.removeAttribute("required");
            toDate.removeAttribute("required");
            fromDN.removeAttribute("required");
            toDN.removeAttribute("required");
            particularsReport.removeAttribute("required");

            nameReport.setAttribute("required", "");
        } else {
            particularsRange.style.display = "block";
            dateRange.style.display = "none";
            dnRange.style.display = "none";
            nameRange.style.display = "none";
            nameReport.value = "";
            fromDate.value = "";
            toDate.value = "";
            fromDN.value = "";
            toDN.value = "";
            fromDate.removeAttribute("required");
            toDate.removeAttribute("required");
            fromDN.removeAttribute("required");
            toDN.removeAttribute("required");
            nameReport.removeAttribute("required");

            particularsReport.setAttribute("required", "");
        }

    });

    function from(e){
        var fromDate = e.target.value;
        document.getElementById("toDate").setAttribute("min", fromDate);
        }

        function to(e){
        var toDate = e.target.value;
        document.getElementById("fromDate").setAttribute("max", toDate);
        }