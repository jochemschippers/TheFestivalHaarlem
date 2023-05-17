fetch('paymentpage/getPersonalProgramItems', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        cart: JSON.parse(sessionStorage.getItem('personalProgram') || '[]'),
    })
}).then(response => response.json())
    .then(data => {
        const timeslots = data['timeslots'];
        displayTimeslots(timeslots);
    })
    .catch(error => {
        console.error('Error fetching timeslots data:', error);
    });

function displayTimeslots(timeslots) {
    const timeslotsContainer = document.getElementById('timeslots-container');

    timeslots.forEach(timeslot => {
        const timeslotCard = createTimeslotCard(timeslot);
        timeslotsContainer.appendChild(timeslotCard);
    });
}

function createTimeslotCard(timeslot) {
    const card = document.createElement('div');
    card.classList.add('card', 'mb-4', 'col-md-6', 'col-lg-4');

    const cardBody = document.createElement('div');
    cardBody.classList.add('card-body');

    const title = document.createElement('h5');
    title.classList.add('card-title');
    title.textContent = timeslot.artist.name;

    const startTime = new Date(timeslot.startTime);
    const endTime = new Date(timeslot.endTime);

    const time = document.createElement('p');
    time.classList.add('card-text');
    time.textContent = `${startTime.toLocaleDateString()} ${startTime.toLocaleTimeString()} - ${endTime.toLocaleTimeString()}`;

    const location = document.createElement('p');
    location.classList.add('card-text');
    location.textContent = `${timeslot.jazzLocation.locationName}, ${timeslot.hall.hallName}`;

    const price = document.createElement('p');
    price.classList.add('card-text');
    price.textContent = `€${timeslot.price}`;

    cardBody.appendChild(title);
    cardBody.appendChild(time);
    cardBody.appendChild(location);
    cardBody.appendChild(price);
    card.appendChild(cardBody);

    return card;
}