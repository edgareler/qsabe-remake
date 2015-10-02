
window.onload = function() {
    $(function() {
        var chart;

        $(document).ready(function() {

            // Build the chart
            $('#chart-01').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    backgroundColor: 'rgba(255, 255, 255, 0)',
                    plotShadow: false
                },
                tooltip: {
                    pointFormat: '<b>{point.percentage:.1f}%</b>'
                },
                title: {
                    text: 'Questionador'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                        type: 'pie',
                        name: '',
                        data: [
                            ['Perguntas', 133],
                            ['Respostas', 45]
                        ]
                    }]
            });
        });

    });

    $.getJSON("/usuario/getUsuario", function(data) {
        //$.each(data, function(key, val) {
            var imgBtn = document.createElement("img");
            imgBtn.setAttribute("src", "/img/" + data.userIcon);
            imgBtn.setAttribute("width", 30);
            imgBtn.setAttribute("height", 30);
            imgBtn.setAttribute("alt", "Profile");
            
            document.getElementById("main-profile").appendChild(imgBtn);
            
            var txBtn = document.createTextNode(data.userName);
            
            document.getElementById("main-profile").appendChild(txBtn);
        //});
    });
    
    $.getJSON("/usuario/listaUsuarios", function(data) {
        
        $.each(data, function(key, val) {
            var btn = document.createElement("a");
            btn.setAttribute("href","/usuario/mudarUsuario/" + this.id);
            btn.setAttribute("class","profile");
            
            var imgBtn = document.createElement("img");
            imgBtn.setAttribute("src", "/img/" + this.icone);
            imgBtn.setAttribute("width", 30);
            imgBtn.setAttribute("height", 30);
            imgBtn.setAttribute("alt", "Profile");
            
            btn.appendChild(imgBtn);
            
            var txBtn = document.createTextNode(this.nome);
            
            btn.appendChild(txBtn);
            
            document.getElementById("menu-usuario").appendChild(btn);
            
        });
        
    });
    
    $("#main-profile").click(function() {
        $("#menu-usuario").toggle({direction: 'left', duration: 200});
    });
};