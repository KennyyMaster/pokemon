function sortPokemons(order) {
    const container = document.getElementById('pokedex');
    const pokemons = Array.from(container.getElementsByClassName('pokemon-card'));

    pokemons.sort((a, b) => {
        const numA = parseInt(a.getAttribute('data-number'));
        const numB = parseInt(b.getAttribute('data-number'));

        return order === 'asc' ? numA - numB : numB - numA;
    });

    // Clear the container and append the sorted Pokémon cards
    container.innerHTML = '';
    pokemons.forEach(pokemon => container.appendChild(pokemon));
}
