/**
 * Created by Daniel on 30-May-17.
 */
function addQuestion(event) {

    event.preventDefault();

    var question = `
        <div class="question">
          <div class="form-group">
                                <label for="questionName" class="col-md-4 control-label">Intrebare</label>
                                <div class="question-name-wrapper">
                                    <div class="col-md-5">
                                        <input id="questionName" type="text" class="form-control" name="questionName[]" required autofocus>
                                    </div>
                                    <div class="col-md-1">
                                    <button class="btn btn-danger delete-question" onclick="removeQuestion(event)">X</button>
                                    </div>  
                                </div>

                            </div>
</div>
    `;

    $('#questions').append(question);
}

function removeQuestion(event){
    event.preventDefault();
    $(event.target).parentsUntil('#questions').remove();
}

$(document).ready(function () {
    $('#addQuestion').on('click', function (event) {
        addQuestion(event);
    });
});