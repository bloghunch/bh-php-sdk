# Bloghunch PHP SDK

This is the official PHP SDK for the Bloghunch API.

## Installation

You can install the package via composer:

```bash
composer require bloghunch/php-sdk
```

## Usage

```php
use Bloghunch\Bloghunch;
use Bloghunch\Exceptions\BloghunchException;

$bloghunch = new Bloghunch('your-api-key', 'your-domain');

try {
    $posts = $bloghunch->getAllPosts();
    print_r($posts);
} catch (BloghunchException $e) {
    echo "Error: " . $e->getMessage();
}
```

## Available Methods

- `getAllPosts()`
- `getPost(string $slug)`
- `getPostComments(string $postId)`
- `getAllSubscribers()`
- `getAllTags()`

Check out the entire API documentation here [developer.bloghunch.com](https://developer.bloghunch.com/). \
Feel free to reach out to [support](https://bloghunch.com/contact) for any queries.

## Error Handling

All methods can throw a `BloghunchException` if the API request fails.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.