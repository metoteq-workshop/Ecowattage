import * as THREE from 'three';

// 1. Interactive 3D Clean Energy African Globe
export function initEcoGlobe(containerId = 'eco-globe-canvas') {
    const container = document.getElementById(containerId);
    if (!container) return;

    const width = container.clientWidth || 340;
    const height = container.clientHeight || 340;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000);
    camera.position.z = 2.9;

    const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    container.innerHTML = '';
    container.appendChild(renderer.domElement);

    // Group for all rotating elements
    const globeGroup = new THREE.Group();
    scene.add(globeGroup);

    // 1. Inner Wireframe / Particle Globe (Emerald & Mint theme)
    const sphereGeo = new THREE.SphereGeometry(1, 28, 28);
    const wireframeMat = new THREE.MeshBasicMaterial({
        color: 0x00A86B,
        wireframe: true,
        transparent: true,
        opacity: 0.28,
    });
    const globeMesh = new THREE.Mesh(sphereGeo, wireframeMat);
    globeGroup.add(globeMesh);

    // 2. Glowing Core
    const innerGeo = new THREE.SphereGeometry(0.85, 20, 20);
    const innerMat = new THREE.MeshBasicMaterial({
        color: 0x045D3B,
        transparent: true,
        opacity: 0.18,
    });
    const innerMesh = new THREE.Mesh(innerGeo, innerMat);
    globeGroup.add(innerMesh);

    // 3. Clean Energy Particle Ring around the Globe (representing Solar & Wind orbits)
    const ringGeo = new THREE.BufferGeometry();
    const particleCount = 140;
    const positions = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount; i++) {
        const angle = (i / particleCount) * Math.PI * 2;
        const radius = 1.35 + (Math.random() - 0.5) * 0.12;
        positions[i * 3] = Math.cos(angle) * radius;
        positions[i * 3 + 1] = (Math.sin(angle) * radius) * 0.35 + (Math.random() - 0.5) * 0.08;
        positions[i * 3 + 2] = Math.sin(angle) * radius;
    }

    ringGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    const ringMat = new THREE.PointsMaterial({
        color: 0xC8E6C9,
        size: 0.035,
        transparent: true,
        opacity: 0.85,
    });
    const ringPoints = new THREE.Points(ringGeo, ringMat);
    globeGroup.add(ringPoints);

    // 4. Energy Beacon Nodes (e.g. Sierra Leone & African hubs)
    const nodeGeo = new THREE.SphereGeometry(0.04, 12, 12);
    const nodeMat = new THREE.MeshBasicMaterial({ color: 0x00FF9D });
    
    // Position approximate to West Africa (lat: ~8°N, lon: ~-13°W)
    const lat = 8.5 * (Math.PI / 180);
    const lon = -13.2 * (Math.PI / 180);
    const r = 1.02;
    const beacon = new THREE.Mesh(nodeGeo, nodeMat);
    beacon.position.set(
        r * Math.cos(lat) * Math.sin(lon),
        r * Math.sin(lat),
        r * Math.cos(lat) * Math.cos(lon)
    );
    globeGroup.add(beacon);

    // Orbit Pulse Wave
    const pulseRingGeo = new THREE.RingGeometry(0.05, 0.08, 24);
    const pulseRingMat = new THREE.MeshBasicMaterial({
        color: 0x00A86B,
        side: THREE.DoubleSide,
        transparent: true,
        opacity: 0.8,
    });
    const pulseRing = new THREE.Mesh(pulseRingGeo, pulseRingMat);
    pulseRing.position.copy(beacon.position);
    pulseRing.lookAt(new THREE.Vector3(0, 0, 0));
    globeGroup.add(pulseRing);

    // Interactive mouse drag & rotation
    let isDragging = false;
    let prevMouseX = 0;
    let prevMouseY = 0;
    let targetRotationX = 0.2;
    let targetRotationY = 0.5;

    const onMouseDown = (e) => {
        isDragging = true;
        prevMouseX = e.clientX;
        prevMouseY = e.clientY;
    };

    const onMouseMove = (e) => {
        if (!isDragging) return;
        const deltaX = e.clientX - prevMouseX;
        const deltaY = e.clientY - prevMouseY;
        targetRotationY += deltaX * 0.007;
        targetRotationX += deltaY * 0.007;
        prevMouseX = e.clientX;
        prevMouseY = e.clientY;
    };

    const onMouseUp = () => {
        isDragging = false;
    };

    container.addEventListener('mousedown', onMouseDown);
    window.addEventListener('mousemove', onMouseMove);
    window.addEventListener('mouseup', onMouseUp);

    // Touch support for mobile devices
    container.addEventListener('touchstart', (e) => {
        if (e.touches.length === 1) {
            isDragging = true;
            prevMouseX = e.touches[0].clientX;
            prevMouseY = e.touches[0].clientY;
        }
    }, { passive: true });

    window.addEventListener('touchmove', (e) => {
        if (!isDragging || e.touches.length !== 1) return;
        const deltaX = e.touches[0].clientX - prevMouseX;
        const deltaY = e.touches[0].clientY - prevMouseY;
        targetRotationY += deltaX * 0.007;
        targetRotationX += deltaY * 0.007;
        prevMouseX = e.touches[0].clientX;
        prevMouseY = e.touches[0].clientY;
    }, { passive: true });

    window.addEventListener('touchend', onMouseUp);

    // Resize observer
    const resizeObserver = new ResizeObserver(() => {
        const newW = container.clientWidth || 340;
        const newH = container.clientHeight || 340;
        camera.aspect = newW / newH;
        camera.updateProjectionMatrix();
        renderer.setSize(newW, newH);
    });
    resizeObserver.observe(container);

    let pulseScale = 1;
    let pulseGrowing = true;

    // Animation Loop
    function animate() {
        requestAnimationFrame(animate);

        // Constant gentle background rotation
        if (!isDragging) {
            targetRotationY += 0.0035;
        }

        // Smooth damping
        globeGroup.rotation.y += (targetRotationY - globeGroup.rotation.y) * 0.08;
        globeGroup.rotation.x += (targetRotationX - globeGroup.rotation.x) * 0.08;

        // Counter-spin the orbital particle ring
        ringPoints.rotation.y -= 0.002;
        ringPoints.rotation.z += 0.001;

        // Pulse effect on beacon
        if (pulseGrowing) {
            pulseScale += 0.015;
            if (pulseScale > 1.8) pulseGrowing = false;
        } else {
            pulseScale -= 0.015;
            if (pulseScale < 0.9) pulseGrowing = true;
        }
        pulseRing.scale.set(pulseScale, pulseScale, 1);
        pulseRingMat.opacity = Math.max(0.1, 1 - (pulseScale - 0.9));

        renderer.render(scene, camera);
    }
    animate();
}

// 2. Interactive 3D Card Tilt Effect (Applies to all elements with class `card-3d-tilt`)
export function initCard3DTilt() {
    const cards = document.querySelectorAll('.card-3d-tilt');
    if (!cards.length) return;

    cards.forEach((card) => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const rotateX = ((y - centerY) / centerY) * -9;
            const rotateY = ((x - centerX) / centerX) * 9;

            card.style.transform = `perspective(1000px) rotateX(${rotateX.toFixed(2)}deg) rotateY(${rotateY.toFixed(2)}deg) translateY(-4px)`;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });
    });
}

// Auto-run on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    initEcoGlobe('eco-globe-canvas');
    initCard3DTilt();
});
