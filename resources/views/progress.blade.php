<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="questionAdd">
                        <div class="p-2 bg-gray" >
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        My Progress
                                    </h3>
                                </div>
                            </div>
                                <div class="sm:px-6 sm:w-1/2 sm:m-10 m-auto">
                                    <h2 class="text-3xl">{{ Auth::user()->name }}</h2>
                                    <hr/>
                                    <h5>Question Attempted : <span id="qa">_</span></h5>
                                    <hr/>
                                    <h5>Score : <span id="score">_</span></h5>
                                    <hr/>
                                    <h5>Question Contributed : <span id="qc">_</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>



$(document).ready(() => {

                    $.ajax({
                        method: "GET",
                        url:  '/progress/{{ Auth::user()->id }}',
                    }).done(function( res ) {
                        if(res){
                            $('#qa').text(res.total);
                            $('#score').text(res.score);
                            $('#qc').text(res.question_contributed);
                        }

                        })
                    })
    </script>
    @endsection
</x-app-layout>
