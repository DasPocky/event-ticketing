<!-- Liste in einer TailwindCSS Tabelle alle events auf, nimm Bezug auf das Model "event" -->
<x-organizer-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold tracking-widest text-gray-500 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="p-10 max-w-7xl mx-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <!-- Zeige alle Errors des Events an -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('organizer.events.update', $event) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Venue -->
                <div class="px-6 py-4">
                    <x-input-label for="title" :value="__('Venue')" />
                    <select id="venue" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="venue_id" required autofocus>
                        @foreach ($venues as $venue)
                            <option value="{{ $venue->id }}" {{ $event->venue_id == $venue->id ? 'selected' : '' }}>{{ $venue->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('venue')" class="mt-2" />
                </div>

                <!-- Category -->
                <div class="px-6 py-4">
                    <x-input-label for="title" :value="__('Category')" />
                    <select id="subCategory" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="sub_category_id" required autofocus>
                        @foreach ($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach ($category->subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ $event->sub_category_id == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <!-- Title -->
                <div class="px-6 py-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $event->title }}" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="px-6 py-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea  id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="description" required autofocus>{{ $event->description }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Entry Date -->
                <div class="px-6 py-4">
                    <x-input-label for="entry_datetime" :value="__('Entry Date')" />
                    <input id="entry_datetime" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="datetime-local" name="entry_datetime" value="{{ $event->entry_datetime }}" autofocus />
                    <x-input-error :messages="$errors->get('entry_datetime')" class="mt-2" />
                </div>

                <!-- Start Date -->
                <div class="px-6 py-4">
                    <x-input-label for="start_datetime" :value="__('Start Date')" />
                    <input id="start_datetime" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="datetime-local" name="start_datetime" value="{{ $event->start_datetime }}" required autofocus />
                    <x-input-error :messages="$errors->get('start_datetime')" class="mt-2" />
                </div>

                <!-- End Date -->
                <div class="px-6 py-4">
                    <x-input-label for="end_datetime" :value="__('End Date')" />
                    <input id="end_datetime" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="datetime-local" name="end_datetime" value="{{ $event->end_datetime }}" autofocus />
                    <x-input-error :messages="$errors->get('end_datetime')" class="mt-2" />
                </div>

                <!-- Status Select -->
                <div class="px-6 py-4">
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="status" required autofocus>
                        <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <!-- Image -->
                <div class="px-6 py-4">
                    <x-input-label for="image" :value="__('Current Image')" />

                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="mb-4 w-20 h-20"/>

                    <x-input-label for="image" :value="__('New Image')" />
                    <input id="image" class="block mt-1 w-full" type="file" name="image"/>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>



                <!-- Website -->
                <div class="px-6 py-4">
                    <x-input-label for="website" :value="__('Website')" />
                    <x-text-input id="website" class="block mt-1 w-full" type="text" name="website" value="{{ $event->website }}" required autofocus />
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>


                <!-- Submit Button -->
                <div class="px-6 py-4 bg-gray-50 text-right">
                    <x-primary-button href="{{ route('organizer.venues.create') }}">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-organizer-layout>
