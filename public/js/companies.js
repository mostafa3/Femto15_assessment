
$.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});

function search_companies(){
  var search = $('#searchInput').val();
  if(search.length > 2){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
      url: '/Femto15/public/ajax/company_search',
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
           $('.table tbody').append('<tr ><td>'+response.data[i].name+'</td><td>'+response.data[i].email+'</td><td>'+response.data[i].tel+'</td><td>'+response.data[i].address+'</td><td><a href=employee/'+response.data[i].id+'><i class="fas fa-external-link-square-alt icon-large"></i></a></td>  </tr>');
         }
       }
      });
      }else{
    $('.table tbody').html(companies);
  }
}

$(document).ready(function(){
  companies = $('.table tbody').html();

   $("#searchInput").keyup(search_companies);
 // end of file
})


// execute function when keyup or change
