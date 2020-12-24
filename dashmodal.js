document.getElementById('Modal1').addEventListener('click',function() {
document.querySelector('.bg-modal1').style.display = 'flex';
            });
document.querySelector('.close1').addEventListener('click',function(){
document.querySelector('.bg-modal1').style.display = 'none';
            });
document.getElementById('Modal2').addEventListener('click',function() {
document.querySelector('.bg-modal2').style.display = 'flex';
            });
document.querySelector('.close2').addEventListener('click',function(){
document.querySelector('.bg-modal2').style.display = 'none';
            });
document.getElementById('Modal3').addEventListener('click',function() {
document.querySelector('.bg-modal3').style.display = 'flex';
             });
document.querySelector('.close3').addEventListener('click',function(){
document.querySelector('.bg-modal3').style.display = 'none';
            });
document.getElementById('Modal4').addEventListener('click',function() {
document.querySelector('.bg-modal4').style.display = 'flex';
            });
document.querySelector('.close4').addEventListener('click',function(){
document.querySelector('.bg-modal4').style.display = 'none';
            });
document.getElementById('Modal5').addEventListener('click',function() {
document.querySelector('.bg-modal5').style.display = 'flex';
            });
document.querySelector('.close5').addEventListener('click',function(){
document.querySelector('.bg-modal5').style.display = 'none';
            });  
                    
/** Date and Time
 --------------------------------------*/
 function updateClock(){
    var now = new Date();
    var dname = now.getDay(),
        mo = now.getMonth(),
        dnum = now.getDate(),
        yr = now.getFullYear(),
        hou = now.getHours(),
        min = now.getMinutes(),
        sec = now.getSeconds(),
        pe = "AM";
        
        if(hou >= 12){
          pe = "PM";
        }
        if(hou == 0){
          hou = 12;
        }
        if(hou > 12){
          hou = hou - 12;
        }

        Number.prototype.pad = function(digits){
          for(var n = this.toString(); n.length < digits; n = 0 + n);
          return n;
        }

        var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
        var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
        var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
        for(var i = 0; i < ids.length; i++)
        document.getElementById(ids[i]).firstChild.nodeValue = values[i];
  }

  function initClock(){
    updateClock();
    window.setInterval("updateClock()", 1);
  }
  function closeTable(){
    document.getElementById('SearchTable').style.display = 'none';
  }
