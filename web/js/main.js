/**
 * Created by Sam on 01/10/2016.
 */

$(document).ready(function () {

    $( "#users_adresses_ville" ).autocomplete({

        source:function (request, response)
        {
            // $.get('http://localhost/Ecommerce/web/app_dev.php/ville/'+request.term
            //
            //     , function (data) {
            //     // assuming data is a JavaScript array such as
            //     // ["one@abc.de", "onf@abc.de","ong@abc.de"]
            //     // and not a string
            //     response(data);
            // });

            $.ajax({
                    type:'get',
                    url:Routing.generate('ville', { nom: request.term} ),
                    // url: 'http://localhost/Ecommerce/web/app_dev.php/ville/'+request.term,
                    beforeSend:function () {
                        $('#img').show();
                    },
                    success:function (data) {
                        response(data);
                        $('#img').hide();
                        console.log('done !');
                    },
                    error:function (data,status) {
                        $('#img').hide();
                        console.log('Error : '+status);
                    }
                });

        }
    });
});