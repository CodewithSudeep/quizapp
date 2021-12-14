<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div id="timer"></div>
                    <form id="questionBank">
                        <div class="p-2 bg-gray" id="questionHeader" >
                            <div class="text-center">
                                <div class="loadingio-spinner-pulse-nb605kmnwcp"><div class="ldio-xewc9m53fj">
                                    <div></div><div></div><div></div>
                                    </div></div>
                            </div>
                        </div>
                        <div id="optionHeader">
                        <div class="p-2">

                        </div>
                        </div>
                          <div class="p-4 bg-white hidden" id="submitBtn" >
                            <button type="btn" id="answer" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3 animate__animated animate__slideInLeft">
                                Submit
                            </button>
                          </div>
                        </form>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')

    <script>
$(document).ready(() => {
    let time = 60;
    setInterval(() => {
        if(time>0){
            time--;
            $('#timer').html(`<div class="text-right timer"><h3>Timer: ${time}</h3></div>`);
        }
        else{
            $('#timer').html('');
            $('#questionHeader').html('<div class="text-center">Time Up</div>');
            $('#optionHeader').html('');
            $('#submitBtn').html('');
            return;
        }

    }, 1000);

$.ajax({
    method: "GET",
    url:  '/getQuestion',

}).done(function( res ) {
    if(res.status == "ok"){
        makeQuestion(res.data);
        $("#submitBtn").show();
    }
})
})

let answer,correct,currentQuestion;
const setAnswer = (e) =>{
    answer = e.target.value;
}

const makeQuestion = (data) =>{
    if(!data){
        $("#questionHeader").html("<h1 class='text-center text-2xl font-bold'>No Questions Found</h1>");
        $("#submitBtn").style('display','none');
        return;
    }
    const { question_name, options, id, correct_answer } = data;
    correct = correct_answer;
    currentQuestion = id;
    const question_html = `<div class='animate__animated animate__slideInLeft'><h3>${id}. ${question_name}</h3>
                            <input type="hidden" name="question_id" id="question_id" value="${id}"></div>`;
    const options_html = options.map(option => `<div class="p-2 animate__animated animate__slideInLeft"><input type="radio" name="question1" value="${option.option_name}" onchange="setAnswer(event)"> ${option.option_name} <br></div>`).join('');
    $("#questionHeader").html(question_html);
    $("#optionHeader").html(options_html);
}

$("#questionBank").on('submit', (e) => {
                    e.preventDefault();
                    let staus = "";
                    console.log(answer,correct);
                    if (answer == correct) {
                        showToast("Correct Answer", "success");
                        staus=1;
                    } else {
                        showToast("Wrong Answer", "error");
                        staus=0;
                    }

                    const data = {
                        question_id: currentQuestion,
                        status: staus
                    }
                    console.log(data);
                    $.ajax({
                        method: "POST",
                        url:  '/save_progress',
                        data: data,
                    }).done(function( res ) {
                        if(res.message){
                           makeQuestion(res.data);
                        }
                    })
                })
    </script>
    @endsection
</x-app-layout>
