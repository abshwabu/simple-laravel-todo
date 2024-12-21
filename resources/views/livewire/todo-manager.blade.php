<?php

use Livewire\Volt\Component;
use App\Models\Todo;

new class extends Component {
    public Todo $todo;
    public String $newTodo;
    
    public function with() {
        return [
            'todos' => Auth::user()->todos->all(),
        ];
    }

    public function addTodo() {
        $this->validate([
            'newTodo' => 'required|string|max:255',
        ]);
        Todo::create([
            'name' => $this->pull('newTodo'),
            'user_id' => Auth::id(),
            'user' => Auth::id(),
        ]);
    }

    public function deleteTodo(Todo $todo) {
        $todo->delete();
    }
}; ?>

<div>
    <h1>Todo Manager</h1>
    <form wire:submit="addTodo">
        <input type="text" wire:model="newTodo">
        <button type="submit">Add Todo</button>
    </form>
    @foreach ($todos as $todo)
        <div wire:key="todo-{{ $todo->id }}" class="flex space-x-4 space-y-4 items-center">
            <p>{{ $todo->name }}</p>
            <button wire:click="deleteTodo({{ $todo->id }})" class="bg-red-500 text-white px-2 py-1 rounded-md">Delete</button>
        </div>
    @endforeach
</div>
