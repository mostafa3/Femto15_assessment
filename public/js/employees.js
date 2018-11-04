
$.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});

function search_employees(){
  var search = $('#searchInput').val();
  if(search.length > 2){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
      url: '/Femto15/public/ajax/employee_search',
      type: 'POST',
      data: {search:search},
     beforeSend: function(){
       $('.table tbody').text('Loading');
     },
     success: function(response){
         if(response.data.length <1){
           $('.table tbody').text('Not Found');
           return false;
         }
         $('.table tbody').empty();
         for(i=0;i<response.data.length;i++){
           $('.table tbody').append('<tr ><td>'+response.data[i].name+'</td><td>'+response.data[i].email+'</td><td>'+response.data[i].phone+'</td><td>'+response.data[i].company_name+'</td><td><a href=employee/'+response.data[i].id+'><i class="fas fa-external-link-square-alt icon-large"></i></a></td>  </tr>');
         }
       }
      });
      }else{
    $('.table tbody').html(employees);
  }
}

$(document).ready(function(){
  employees = $('.table tbody').html();

   $("#searchInput").keyup(search_employees);
 // end of file
})


// execute function when keyup or change
