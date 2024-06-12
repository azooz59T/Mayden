<?php

namespace Tests\Unit;

use App\Models\Item;
use Tests\TestCase;

class ShoppingListTest extends TestCase
{
    /**
     * Test that the shopping list exists and has items.
     *
     * @return void
     */
    public function testShoppingListExists()
    {
        // Create some sample items
        $item1 = Item::factory()->create(['name' => 'Item 1']);
        $item2 = Item::factory()->create(['name' => 'Item 2']);

        // Visit the shopping list page
        $response = $this->get(route('item.index'));

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the shopping list exists and contains the items
        $response->assertSeeText('Item 1');
        $response->assertSeeText('Item 2');
    }

    public function testDeleteItemFromShoppingList()
    {
        // Create a sample item
        $item = Item::factory()->create(['name' => 'Item to Delete']);

        // Visit the shopping list page
        $response = $this->get(route('item.index'));

        // Assert that the item exists on the page
        $response->assertSeeText('Item to Delete');

        // Delete the item
        $this->delete(route('item.destroy', $item->id));

        // Visit the shopping list page again
        $response = $this->get(route('item.index'));

        // Assert that the item no longer exists on the page
        $response->assertDontSeeText('Item to Delete');
    }

        /**
     * Test if clicking the "Tick" button updates the item's ticked status.
     *
     * @return void
     */
    public function testTickingAnItem()
    {
        // Create a sample item with ticked status set to false
        $item = Item::factory()->create(['name' => 'Item to Tick', 'ticked' => false]);

        // Visit the shopping list page
        $response = $this->get(route('item.index'));

        // Assert that the item's ticked status is initially "No"
        $response->assertSeeText('No');

        // Tick the item by sending a GET request to the "tick" route
        $this->get(route('tick', $item->id));

        // Visit the shopping list page again after ticking the item
        $response = $this->get(route('item.index'));

        // Assert that the item's ticked status is now displayed as the checked.png icon
        $response->assertSee('checked.png', false); // false parameter means to search for HTML elements
    }

    /**
     * Test if shopping list data persists after navigating away and back to the page.
     *
     * @return void
     */
    public function testDataPersistence()
    {
        // Create some sample items
        $item1 = Item::factory()->create(['name' => 'Persisted Item 1']);
        $item2 = Item::factory()->create(['name' => 'Persisted Item 2']);

        // Visit the shopping list page
        $response = $this->get(route('item.index'));

        // Assert that the items exist on the page
        $response->assertSeeText('Persisted Item 1');
        $response->assertSeeText('Persisted Item 2');

        // Navigate to a different page (e.g., the homepage)
        $this->get('/');

        // Navigate back to the shopping list page
        $response = $this->get(route('item.index'));

        // Assert that the items still exist on the page after navigating away and back
        $response->assertSeeText('Persisted Item 1');
        $response->assertSeeText('Persisted Item 2');
    }

}
