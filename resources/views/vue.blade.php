@extends('main')

@section('title', '| Vue Index')



@section('content')
  <section id="special">
    <div class="container">
      {{-- <div id="app">

        <div class="row">
          <products :products="products"></products>

          <pagination :pagination="pagination" @click.native="getProducts(pagination.current_page)"></pagination>
        </div> --}}
        {{-- <form>
          Search <input type="text" name="query" v-model="searchQuery">
        </form>

        <data-viewer :data="gridData" :columns="gridColumns" :filter-key="searchQuery"></data-viewer> --}}

        {{-- <div class="row">
          <div class="col-sm-12">
            <h1>Todo List</h1>

            <ul class="list-group">
              <li class="list-group-item" v-for="todo in todos">
                @{{todo.title}}
                <button class="btn btn-danger pull-right btn-xs" v-on:click="deleteTodo(todo)">Delete</button>
              </li>
            </ul>

            <form v-on:submit.prevent="addNewTodo(newTodo)">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Add a new Todo" v-model="newTodo.title">
              </div>

              <button class="btn btn-success">Add Todo</button>
            </form>
          </div>
        </div> --}}
      </div>
    </div>
  </section>

  {{-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> --}}

@endsection
