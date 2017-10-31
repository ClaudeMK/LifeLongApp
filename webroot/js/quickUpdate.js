$(document).ready(function () {
    
    //Remplir la liste des formations selon le titre de poste de l'employé sélectionné
    $('#employee-id').on('change', function () {      
        var employeeId = $(this).val();
        if (employeeId) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'employee_id=' + employeeId,
                success: function (formations) {                   
                    $select = $('#formation-id');
                    $select.find('option').remove();
                    $.each(formations, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childKey + '>' + childValue + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#formation-id').html('<option value="">Select Category first</option>');
        }
    });
});
