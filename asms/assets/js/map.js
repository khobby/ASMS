function initMap(containerId, lat=0, lng=0, zoom=2) {
  if (typeof L === 'undefined') return null;
  
  // Initialize map
  const map = L.map(containerId).setView([lat, lng], zoom);
  
  // Add tile layer with better styling
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors',
    fadeAnimation: true
  }).addTo(map);
  
  // Add dark mode option
  if (typeof L.tileLayer !== 'undefined') {
    // Add tile layer options
    window.tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    });
  }
  
  // Improve map rendering
  map.on('load', function() {
    map.invalidateSize();
  });
  
  return map;
}

// Enhanced marker creation function
function createMarker(map, lat, lng, icon, popupText) {
  if (!map) return null;
  const marker = L.marker([lat, lng], { icon: icon }).addTo(map);
  if (popupText) {
    marker.bindPopup(popupText);
  }
  return marker;
}

// Create custom icon for aircraft
function createAircraftIcon(type = 'helicopter') {
  const icons = {
    helicopter: '🚁',
    aircraft: '✈️',
    airport: '🛬',
    incident: '⚠️',
    critical: '🔴',
    warning: '🟡'
  };
  
  return L.divIcon({
    html: `<div style="font-size: 30px; line-height: 1; text-shadow: 0 0 8px rgba(0,0,0,0.4);">${icons[type] || type}</div>`,
    className: '',
    iconSize: [32, 32],
    iconAnchor: [16, 16]
  });
}

// Draw route on map
function drawRoute(map, coords, options = {}) {
  const defaults = {
    color: '#3182ce',
    weight: 3,
    dashArray: '8,8',
    opacity: 0.7
  };
  
  const settings = { ...defaults, ...options };
  return L.polyline(coords, settings).addTo(map);
}

// Add geofence circle
function addGeofence(map, lat, lng, radius, options = {}) {
  const defaults = {
    color: '#3182ce',
    fillColor: '#3182ce',
    fillOpacity: 0.1,
    weight: 2,
    radius: radius
  };
  
  const settings = { ...defaults, ...options };
  return L.circle([lat, lng], settings).addTo(map);
}

// Animate marker movement
function animateMarker(marker, coords, duration = 1000, callback = null) {
  let startTime = null;
  const startCoord = marker.getLatLng();
  let coordIndex = 0;
  
  function step(timestamp) {
    if (!startTime) startTime = timestamp;
    const progress = (timestamp - startTime) / duration;
    
    if (progress < 1) {
      const lat = startCoord.lat + (coords[coordIndex].lat - startCoord.lat) * progress;
      const lng = startCoord.lng + (coords[coordIndex].lng - startCoord.lng) * progress;
      marker.setLatLng([lat, lng]);
      requestAnimationFrame(step);
    } else {
      marker.setLatLng(coords[coordIndex]);
      coordIndex++;
      
      if (coordIndex < coords.length) {
        startTime = null;
        startCoord.lat = coords[coordIndex - 1].lat;
        startCoord.lng = coords[coordIndex - 1].lng;
        requestAnimationFrame(step);
      } else if (callback) {
        callback();
      }
    }
  }
  
  requestAnimationFrame(step);
}

// Cluster markers
function clusterMarkers(map, markers, clusterRadius = 50) {
  // Group markers by proximity
  const clusters = [];
  const used = new Set();
  
  markers.forEach((m1, i1) => {
    if (used.has(i1)) return;
    const cluster = [m1];
    used.add(i1);
    
    markers.forEach((m2, i2) => {
      if (used.has(i2)) return;
      const distance = m1.getLatLng().distanceTo(m2.getLatLng());
      if (distance < clusterRadius) {
        cluster.push(m2);
        used.add(i2);
      }
    });
    
    clusters.push(cluster);
  });
  
  return clusters;
}

// Heat map support
function addHeatLayer(map, data, options = {}) {
  if (typeof L.heatLayer === 'undefined') {
    console.warn('Leaflet heat plugin not loaded');
    return null;
  }
  
  const defaults = {
    radius: 25,
    blur: 15,
    maxZoom: 17
  };
  
  const settings = { ...defaults, ...options };
  return L.heatLayer(data, settings).addTo(map);
}
