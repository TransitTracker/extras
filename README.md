<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]



<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/transittracker/extras">
    <img src="https://raw.githubusercontent.com/FelixINX/transit-tracker/master/public/svg/logo.svg" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Transit Tracker <b>Extras Catcher</b> </h3>

  <p align="center">
    A collaborative platform to create a complete static GTFS set of the STM network, including school and industrial trips. Made possible with the help of many <a href="#contributors">contributors</a>.
    <br />
    <a href="https://extras.transittracker.ca"><strong>Launch the app »</strong></a>
    <br />
    <br />
    <a href="https://github.com/transittracker/extras/issues">Report Bug or Request Feature</a>
  </p>
</p>


<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements

This project would not be possible without the contributions of: [@austinhuang0131](https://github.com/austinhuang0131)


<!-- TABLE OF CONTENTS -->
## Table of Contents

* [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)



<!-- ABOUT THE PROJECT -->
## Built With

* [Tailwind](https://github.com/tailwindlabs/tailwindcss)
* [Alpine.js](https://github.com/alpinejs/alpine)
* [Laravel](https://github.com/laravel/laravel)
* [Livewire](https://github.com/livewire/livewire)


<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.


### Prerequisites

You will have to install the following software on your machine.
* PHP 
* NodeJS and Yarn
* Composer


### Installation
 
1. Clone the repo
```sh
git clone https://github.com/transittracker/extras.git
``` 
2. Edit the environment variables
3. Install Composer dependencies
```sh
composer install
```
4. Install npm packages
```sh
yarn install
```
5. Generate the front-end UI
```sh
yarn dev
```
5. Migrate the database
```sh
php artisan migrate
```
6. Start the queue
```sh
php artisan queue:work
```

<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request


<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.


<!-- CONTACT -->
## Contact

Félix Desjardins - [@felixinx](https://twitter.com/felixinx)

Project Link: [https://extras.transittracker.ca](https://extras.transittracker.ca)

Twitter: [https://twitter.com/ttrackerca](https://twitter.com/ttrackerca)


<!-- MARKDOWN LINKS & IMAGES -->
[forks-shield]: https://img.shields.io/github/forks/transittracker/extras.svg?style=flat-square
[forks-url]: https://github.com/transittracker/extras/network/members
[stars-shield]: https://img.shields.io/github/stars/transittracker/extras.svg?style=flat-square
[stars-url]: https://github.com/transittracker/extras/stargazers
[issues-shield]: https://img.shields.io/github/issues/transittracker/extras.svg?style=flat-square
[issues-url]: https://github.com/transittracker/extras/issues
[license-shield]: https://img.shields.io/github/license/transittracker/extras.svg?style=flat-square
[license-url]: https://github.com/transittracker/extras/blob/master/LICENSE.txt