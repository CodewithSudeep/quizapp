<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form id="questionAdd">
                        <div class="p-2 bg-gray" >
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Add Question
                                    </h3>
                                    <label>Enter Question</label>
                            <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="question" value="" onchange="setQuestion(event)">
                        </div>
                        <div id="optionHeader">
                        <div class="p-2">
                            <label>Enter four options seprated by comma</label>
                          <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="options" value="" onchange="setOptions(event)"> <br>
                          <label>Enter correct option</label>
                          <input type="text" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="correct" value="" onchange="setCorrectOption(event)"> <br>
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
   <script>
let question, options, correct;
const setQuestion = (e) =>{
    question = e.target.value;
}
const setOptions = (e) =>{
    options = e.target.value;
}
const setCorrectOption = (e) =>{
    correct = e.target.value;
}

$("#questionAdd").on('submit', (e) => {
                    e.preventDefault();
                    const data = {
                       question:question,
                       options:options,
                       correct: correct,
                       added_by: {{Auth::user()->id}}
                    }

                    $.ajax({
                        method: "POST",
                        url:  '/create_question',
                        data: data,
                    }).done(function(response) {
                        if(response.status=='ok'){
                            showToast("Question added successfully", "success");
                            $("#questionAdd")[0].reset();
                        }
                    })
                })
    </script>
    @endsection
</x-app-layout>
