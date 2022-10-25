<div>
    <h1>Filter Table</h1>
    <form wire:submit.prevent="filter">
        <div class="radio-container">
            <p class="radio-heading">Track</p>
            <div class="radio-group">
                <input type="radio" wire:model="track" name="track" value="ABM" id="ABM" />
                <label for="ABM">ABM</label>
                <input type="radio" wire:model="track" name="track" value="GAS" id="GAS" />
                <label for="GAS">GAS</label>
                <input type="radio" wire:model="track" name="track" value="HUMSS" id="HUMSS" />
                <label for="HUMSS">HUMSS</label>
                <input type="radio" wire:model="track" name="track" value="ICT" id="ICT" />
                <label for="ICT">ICT</label>
                <input type="radio" wire:model="track" name="track" value="STEM" id="STEM" />
                <label for="STEM">STEM</label>
                <input type="radio" wire:model="track" name="track" value="SPORT" id="SPORT" />
                <label for="SPORT">SPORT</label>
            </div>
            @error('track') <span class="error">{{ $message }}</span> @enderror
        </div>
    
        <div class="radio-container">
            <p class="radio-heading">Grade Level</p>
            <div class="radio-group">
                <input type="radio" wire:model="grade" name="grade" value="11" id="eleven" />
                <label for="eleven">11</label>
                <input type="radio" wire:model="grade" name="grade" value="12" id="twelve" />
                <label for="twelve">12</label>
            </div>
            @error('grade') <span class="error">{{ $message }}</span> @enderror
        </div>
    
        <div class="radio-container">
            <p class="radio-heading">Section</p>
            <div class="radio-group">
                <input type="radio" wire:model="section" name="section" value="A" id="section-a" />
                <label for="section-a">A</label>
                <input type="radio" wire:model="section" name="section" value="B" id="section-b" />
                <label for="section-b">B</label>
            </div>
            @error('section') <span class="error">{{ $message }}</span> @enderror
        </div>
        <input type="submit" id="submit" value="Apply Filters">
    </form>
    

    
</div>
