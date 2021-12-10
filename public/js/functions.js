$(document).ready(function(){
//     $('.combobox').combobox();
    
//     // bonus: add a placeholder
//     $('.combobox').attr('placeholder', 'For example, start typing "Pennsylvania"');
//   });
    // alert("test");
    function fetchData(){
    fetch('/api/items');
    }

    fetchData();
  });