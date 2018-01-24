@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div class="row" style="margin-top: 20px;">
        <form class="col s12" id="store-result-form" action="/admin/result" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s6">
                    <textarea id="25_result" class="materialize-textarea" name="25_result">{{isset($test_results[25]) ? $test_results[25] : ''}}</textarea>
                    <label for="25_result">0% - 25% правильных ответов</label>
                </div>

                <div class="input-field col s6">
                    <textarea id="50_result" class="materialize-textarea" name="50_result">{{isset($test_results[50]) ? $test_results[50] : ''}}</textarea>
                    <label for="50_result">26% - 50% правильных ответов</label>
                </div>

                <div class="input-field col s6">
                    <textarea id="75_result" class="materialize-textarea" name="75_result">{{isset($test_results[75]) ? $test_results[75] : ''}}</textarea>
                    <label for="75_result">51% - 75% правильных ответов</label>
                </div>

                <div class="input-field col s6">
                    <textarea id="90_result" class="materialize-textarea" name="90_result">{{isset($test_results[90]) ? $test_results[90] : ''}}</textarea>
                    <label for="90_result">75% - 90% правильных ответов</label>
                </div>

                <div class="input-field col s6">
                    <textarea id="100_result" class="materialize-textarea" name="100_result">{{isset($test_results[100]) ? $test_results[100] : ''}}</textarea>
                    <label for="100_result">Более 91% правильных ответов</label>
                </div>

                <div class="input-field col s12">
                    <div class="input-field col s6">
                        <h5>Информация о текущем проекте и полезные ссылки:</h5>
                        <textarea id="final_info" class="materialize-textarea" name="final_info">{{isset($test_results['info']) ? $test_results['info'] : ''}}</textarea>
                        <label for="final_info"></label>
                    </div>
                </div>

            </div>
            <div style="margin-top: 30px; margin-left: 15px;">
                <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905" id="store-news">Сохранить</button>
            </div>
        </form>
    </div>

    <script>


    </script>
@endsection