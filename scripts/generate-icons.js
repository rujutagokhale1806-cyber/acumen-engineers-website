const fs = require('fs');
const path = require('path');

const services = [
    {
        name: 'service-project-management',
        title: 'Project Management',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="6" y="8" width="36" height="32" rx="4"/>
            <path d="M14 18h20M14 26h12M14 34h8"/>
            <circle cx="34" cy="30" r="4" fill="#F59E0B" stroke="#F59E0B"/>
            <path d="M33 30l1 1 2-2" stroke="#FFFFFF" stroke-width="1.5"/>
        </svg>`
    },
    {
        name: 'service-erection',
        title: 'Erection & Commissioning',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M8 42h32M14 42V16l10-10 10 10v26M20 22h8M20 30h8M20 38h8"/>
            <path d="M6 16l8-8 8 8" stroke="#F59E0B"/>
        </svg>`
    },
    {
        name: 'service-piping',
        title: 'Piping & Clean Room Piping',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 14h18a6 6 0 0 1 6 6v14a6 6 0 0 0 6 6h6"/>
            <path d="M6 22h14a2 2 0 0 1 2 2v14a2 2 0 0 0 2 2h18"/>
            <circle cx="27" cy="23" r="3" fill="#F59E0B" stroke="#F59E0B"/>
        </svg>`
    },
    {
        name: 'service-cabling',
        title: 'Cabling & Instrumentation',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="8" y="10" width="32" height="20" rx="3"/>
            <path d="M16 20h4M24 20h8M14 30v8M34 30v8M10 38h28"/>
            <circle cx="20" cy="20" r="2" fill="#F59E0B"/>
        </svg>`
    },
    {
        name: 'service-fabrication',
        title: 'SS/MS Fabrication',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="10" y="12" width="28" height="24" rx="6"/>
            <path d="M10 20h28M10 28h28M24 6v6M24 36v6"/>
            <circle cx="24" cy="24" r="3" fill="#F59E0B" stroke="#F59E0B"/>
        </svg>`
    },
    {
        name: 'service-welding',
        title: 'Specialized Welding',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10 38l14-14M24 24l6-6 4 4-6 6"/>
            <path d="M34 18l6-6M8 40l6-2-4-4z" fill="#0A4FA8"/>
            <path d="M28 10l2 2M38 20l2 2" stroke="#F59E0B"/>
            <circle cx="34" cy="14" r="2" fill="#F59E0B"/>
        </svg>`
    },
    {
        name: 'service-maintenance',
        title: 'Plant AMC & ARC Maintenance',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="24" cy="24" r="8"/>
            <path d="M24 6v4M24 38v4M6 24h4M38 24h4M11.3 11.3l2.8 2.8M33.9 33.9l2.8 2.8M11.3 36.7l2.8-2.8M33.9 14.1l2.8-2.8"/>
            <path d="M21 24l2 2 4-4" stroke="#F59E0B" stroke-width="2"/>
        </svg>`
    },
    {
        name: 'service-insulation',
        title: 'Thermal & Cold Insulation',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="8" y="14" width="32" height="20" rx="4"/>
            <path d="M16 14v20M24 14v20M32 14v20M8 24h32"/>
            <circle cx="24" cy="24" r="3" fill="#F59E0B"/>
        </svg>`
    },
    {
        name: 'service-goods',
        title: 'Engineering Goods Supply',
        svg: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M8 14l16-8 16 8v20l-16 8-16-8z"/>
            <path d="M8 14l16 8 16-8M24 22v26"/>
            <circle cx="24" cy="22" r="3" fill="#F59E0B"/>
        </svg>`
    }
];

const sectors = [
    { name: 'sector-brewery', title: 'Brewery & Distillery', icon: 'M14 10h20v6l-4 6v14a4 4 0 0 1-4 4h-4a4 4 0 0 1-4-4V22l-4-6z' },
    { name: 'sector-dairy', title: 'Food, Beverages & Dairies', icon: 'M16 8h16v6H16zM14 14h20v24a4 4 0 0 1-4 4H18a4 4 0 0 1-4-4z' },
    { name: 'sector-pharma', title: 'Pharmaceutical', icon: 'M14 24h20M24 14v20M10 8h28a2 2 0 0 1 2 2v28a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2z' },
    { name: 'sector-chemical', title: 'Chemical & Paint', icon: 'M20 8h8M22 8v8l-10 18a4 4 0 0 0 3.5 6h17a4 4 0 0 0 3.5-6L26 16V8' },
    { name: 'sector-water', title: 'Water Treatment', icon: 'M24 6s-12 14-12 22a12 12 0 0 0 24 0C36 20 24 6 24 6z' },
    { name: 'sector-sugar', title: 'Sugar Factories', icon: 'M10 14h28v20H10zM14 8v6M34 8v6M10 24h28' },
    { name: 'sector-oil-gas', title: 'Oil & Gas Plants', icon: 'M24 6v8M16 14h16l4 24H12zM16 26h16M20 32h8' },
    { name: 'sector-refinery', title: 'Oil Refineries', icon: 'M8 40V18l12-6v28M20 24l12-6v22M32 30l8-4v14M8 40h32' },
    { name: 'sector-surface', title: 'Surface Treatment', icon: 'M6 24h36M12 12l6 6M24 8v8M36 12l-6 6M12 36l6-6M24 40v-8M36 36l-6-6' },
    { name: 'sector-process', title: 'Process Industries', icon: 'M10 38V18l14-8 14 8v20M18 26h12v12H18z' }
];

const sDir = path.join(__dirname, '../assets/icons/services');
services.forEach(s => {
    fs.writeFileSync(path.join(sDir, `${s.name}.svg`), s.svg);
});
console.log(`Generated ${services.length} service icons.`);

const secDir = path.join(__dirname, '../assets/icons/sectors');
sectors.forEach(sec => {
    const svg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" stroke="#0A4FA8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="${sec.icon}"/>
        <circle cx="34" cy="14" r="3" fill="#F59E0B" stroke="#F59E0B"/>
    </svg>`;
    fs.writeFileSync(path.join(secDir, `${sec.name}.svg`), svg);
});
console.log(`Generated ${sectors.length} sector icons.`);
