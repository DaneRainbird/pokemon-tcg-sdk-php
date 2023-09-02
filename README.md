# Pokémon TCG SDK
This is a personal fork of the Pokémon TCG SDK PHP implementation, originally developed by mmonkey@gmail.com. 

This fork adds features to the original, including basic OR and AND searches for the `where()` function.

## Installation
    
    composer require danerainbird/pokemon-tcg-sdk-php
    
## Usage
This fork of pokemon-tcg-sdk-php adds a very basic ability to use AND and OR operators when using the `where()` operation:

**AND Operator:**

    Pokemon::Card()->where(['types' => ['AND', 'grass', 'lightning']])->all();
Will return all cards that have the types of Lightning AND Grass

**OR Operator:**

    Pokemon::Card()->where(['types' => ['OR', 'grass', 'lightning']])->all();
Will return all cards that have the types of Lightning OR Grass

These operators be chained with other, standard `where()` queries, such as the following:

    Pokemon::Card()->where(['types' => ['OR', 'grass', 'lightning'], 'rarity' => 'vmax'])->all();
Will return all card that have the types of Lightning OR Grass, and a Rarity of VMAX.

## Original Functionality?
All details pertaining to the original functionality (i.e. how to use it, how to authenticate, etc.) of `pokemon-tcg-sdk-php` can be found [at it's GitHub repo](https://github.com/PokemonTCG/pokemon-tcg-sdk-php).
