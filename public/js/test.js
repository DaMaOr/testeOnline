/**
 * Created by Daniel on 30-May-17.
 */
function addQuestion(event, counter) {

    event.preventDefault();

    var question = `
        <div class="question">
          <div class="form-group">
                                <label for="questionName" class="col-md-4 control-label">Intrebare</label>
                                <div class="question-name-wrapper col-md-8">
                                    <div class="col-md-5">
                                        <input id="questionName" type="text" class="form-control" name="questionName[${counter}][body]" required autofocus>
                                        <div class="col-md-12">
                                            <div class="answer-wrap">
                                                <input class="form-control" type="text" name="questionName[${counter}][answers][0][body]">
                                                <div class="checkbox">
                                                  <label><input type="checkbox" value="true" name="questionName[${counter}][answers][0][correct]">Corect</label>
                                                </div>
                                            </div>
                                           <div class="answer-wrap">
                                                <input class="form-control" type="text" name="questionName[${counter}][answers][1][body]">
                                                 <div class="checkbox">
                                                  <label><input type="checkbox" value="true" name="questionName[${counter}][answers][1][correct]">Corect</label>
                                                </div>
                                            </div>
                                            <div class="answer-wrap">
                                                <input type="text" class="form-control" name="questionName[${counter}][answers][2][body]">
                                                 <div class="checkbox">
                                                  <label><input type="checkbox" value="true" name="questionName[${counter}][answers][2][correct]">Corect</label>
                                                </div>
                                            </div>
                                             <div class="answer-wrap">
                                                <input type="text" class="form-control" name="questionName[${counter}][answers][3][body]">
                                                 <div class="checkbox">
                                                  <label><input type="checkbox" value="true" name="questionName[${counter}][answers][3][correct]">Corect</label>
                                                </div>
                                            </div>

</div>
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
    var questionCounter  = 0;

    $('#addQuestion').on('click', function (event) {
        addQuestion(event, questionCounter);
        questionCounter++;
    });
});