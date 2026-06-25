<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Contact;

#[Layout('components.layouts.admin')]
#[Title('Contact Messages')]
class Contacts extends Component
{
    use WithPagination;

    public string $filter = 'all';
    public ?Contact $viewing = null;

    public function filterBy(string $filter): void
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function view(int $id): void
    {
        $this->viewing = Contact::findOrFail($id);
        if (!$this->viewing->is_read) {
            $this->viewing->update(['is_read' => true, 'read_at' => now()]);
        }
    }

    public function closeView(): void
    {
        $this->viewing = null;
    }

    public function markUnread(int $id): void
    {
        Contact::findOrFail($id)->update(['is_read' => false, 'read_at' => null]);
        $this->viewing = null;
        $this->dispatch('toast', type: 'success', title: 'Marked unread', message: 'Message marked as unread.');
    }

    public function delete(int $id): void
    {
        Contact::destroy($id);
        $this->viewing = null;
        $this->dispatch('toast', type: 'success', title: 'Deleted', message: 'Message deleted.');
    }

    public function render()
    {
        $query = Contact::latest();

        if ($this->filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($this->filter === 'read') {
            $query->where('is_read', true);
        }

        $contacts = $query->paginate(20);
        $unreadCount = Contact::where('is_read', false)->count();

        return view('livewire.admin.contacts', compact('contacts', 'unreadCount'));
    }
}