<x-layout>
    <x-bread-crumbs :$job class="mb-4" :links="[
        'Jobs' => route('jobs.index'),
        $job->title => route('jobs.show', $job),
        'Apply' => '#',
    ]" />

    <x-job-card : $job />

    <x-card>
        Apply!
    </x-card>
</x-layout>
