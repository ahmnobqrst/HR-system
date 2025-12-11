var config = {
    container: "#custom-colored",
    levelSeparation: 60,
    // rootOrientation: "WEST",
    padding: 70,
    scrollbar: "fancy",

    nodeAlign: "BOTTOM",
    
    connectors: {
        type: 'step',
        style: {
            "stroke-width": 2,
            'stroke': '#2bc3d2',
            'arrow-end': 'block-wide-long',
            "stroke-dasharray": "-",
            // 'arrow-start': 'classic-wide-long'
        }
    },
    node: {
        HTMLclass: 'nodeExample2'
    }
},
ceo = {
    text: {
        name: "Executive Manager",
    },

},

cto = {
    parent: ceo,
    HTMLclass: 'light-gray',
    text:{
        name: "Finance Department",
    },

},
cbo = {
    parent: ceo,
    childrenDropLevel: 0,
    HTMLclass: 'blue',
    text:{
        name: "HR Department",
    },

},
cdo = {
    parent: ceo,
    HTMLclass: 'gray',
    text:{
        name: "Contracts Department",
    },

},
cio = {
    parent: cto,
    HTMLclass: 'light-gray',
    text:{
        name: "Finance Manager",
    },

},
ciso = {
    parent: cio,
    HTMLclass: 'light-gray',
    text:{
        name: "Accounting Manager",
    },

},
cio2 = {
    parent: cdo,
    HTMLclass: 'gray',
    text:{
        name: "Contract Manager",
    },

},
ciso2 = {
    parent: cbo,
    HTMLclass: 'blue',
    text:{
        name: "HR Manager",
    },

},
ciso3 = {
    parent: ciso2,
    HTMLclass: 'blue',
    text:{
        name: "Senior Administrator",
    },

},
ciso4 = {
    parent: ciso2,
    HTMLclass: 'blue',
    text:{
        name: "Governmental Officer",
    },
},
ciso5 = {
    parent: ciso4,
    HTMLclass: 'blue',
    text:{
        name: "Coordinator",
    },
},

chart_config = [
    config,
    ceo,cto,cbo,
    cdo,cio,ciso,
    cio2,ciso2,ciso3,ciso4,ciso5
];



// var config = {
//     container: "#company-structure",

//     nodeAlign: "BOTTOM",
    
//     connectors: {
//         type: 'step'
//     },
//     node: {
//         HTMLclass: 'nodeExample1'
//     }
// },
// ceo1 = {
//     text: {
//         name: "Mark Hill",
//         title: "Chief executive officer",
//         contact: "Tel: 01 213 123 134",
//     },
//     image: "../headshots/2.jpg"
// },

// cto1 = {
//     parent: ceo1,
//     HTMLclass: 'light-gray',
//     text:{
//         name: "Joe Linux",
//         title: "Chief Technology Officer",
//     },
//     image: "../headshots/1.jpg"
// },
// cbo1 = {
//     parent: ceo1,
//     childrenDropLevel: 0,
//     HTMLclass: 'blue',
//     text:{
//         name: "Linda May",
//         title: "Chief Business Officer",
//     },
//     image: "../headshots/5.jpg"
// },
// cdo1 = {
//     parent: ceo1,
//     HTMLclass: 'gray',
//     text:{
//         name: "John Green",
//         title: "Chief accounting officer",
//         contact: "Tel: 01 213 123 134",
//     },
//     image: "../headshots/6.jpg"
// },
// cio1 = {
//     parent: cto1,
//     HTMLclass: 'light-gray',
//     text:{
//         name: "Ron Blomquist",
//         title: "Chief Information Security Officer"
//     },
//     image: "../headshots/8.jpg"
// },
// ciso1 = {
//     parent: cto1,
//     HTMLclass: 'light-gray',
//     text:{
//         name: "Michael Rubin",
//         title: "Chief Innovation Officer",
//         contact: "we@aregreat.com"
//     },
//     image: "../headshots/9.jpg"
// },
// cio12 = {
//     parent: cdo1,
//     HTMLclass: 'gray',
//     text:{
//         name: "Erica Reel",
//         title: "Chief Customer Officer"
//     },
//     link: {
//         href: "http://www.google.com"
//     },
//     image: "../headshots/10.jpg"
// },
// ciso12 = {
//     parent: cbo1,
//     HTMLclass: 'blue',
//     text:{
//         name: "Alice Lopez",
//         title: "Chief Communications Officer"
//     },
//     image: "../headshots/7.jpg"
// },
// ciso13 = {
//     parent: cbo1,
//     HTMLclass: 'blue',
//     text:{
//         name: "Mary Johnson",
//         title: "Chief Brand Officer"
//     },
//     image: "../headshots/4.jpg"
// },
// ciso14 = {
//     parent: cbo1,
//     HTMLclass: 'blue',
//     text:{
//         name: "Kirk Douglas",
//         title: "Chief Business Development Officer"
//     },
//     image: "../headshots/11.jpg"
// },

// chart_config = [
//     config1,
//     ceo1,cto1,cbo1,
//     cdo1,cio1,ciso1,
//     cio2,ciso12,ciso13,ciso14
// ];

tree = new Treant( chart_config );