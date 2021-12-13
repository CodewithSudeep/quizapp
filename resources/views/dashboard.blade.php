<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="questionBank">
                        <div class="p-2 bg-gray" id="questionHeader" >
                            <h3>1. Question Here</h3>
                            <input type="hidden" name="question_id" value="2">
                        </div>
                        <div id="optionHeader">
                        <div class="p-2">
                          <input type="radio" name="question1" value="1" onchange="setAnswer(event)"> Answer <br>
                        </div>
                        </div>
                          <div class="p-4 bg-white ">
                            <button type="btn" id="answer" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>

let answer;
const setAnswer = (e) =>{
    answer = e.target.value;
}

const makeQuestion = (data) =>{
    const { question, options, question_id } = data;
    const question_html = `<h3>${question}</h3>
                            <input type="hidden" name="question_id" value="${question_id}">`;
    const options_html = options.map(option => `<div class="p-2"><input type="radio" name="question1" value="${option.id}" onchange="setAnswer(event)"> ${option.option} <br></div>`).join('');
    $("#questionHeader").html(question_html);
    $("#optionHeader").html(options_html);
}

$("#questionBank").on('submit', (e) => {
                    e.preventDefault();
                    const data = {
                        questionId: $("#question_id").value,
                        answer: answer
                    }
                    $.ajax({
                        method: "POST",
                        url:  '/your/url/to/post',
                        data: data,
                    }).done(function( res ) {
                        if(res == "ok"){
                            var url = "/url/to/redirect";
                        // setTimeout($(location).attr('href', url),3000);
                        }
                    })
                })
    </script>
    @endsection
</x-app-layout>
