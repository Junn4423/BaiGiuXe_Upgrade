// Test script to validate all dialog components
// This helps ensure all dialogs are properly structured and can be imported

import React from 'react';

// Import all dialog components
import ParkingZoneDialog from './ParkingZoneDialog.jsx';
import CameraManagementDialogNew from './CameraManagementDialogNew.jsx';
import RfidManagerDialogNew from './RfidManagerDialogNew.jsx';
import PricingPolicyDialog from './PricingPolicyDialog.jsx';
import GateManagementDialog from './GateManagementDialog.jsx';

// Test component to render all dialogs
const DialogTester = () => {
  const [activeDialog, setActiveDialog] = React.useState(null);

  const dialogs = [
    { name: 'ParkingZone', component: ParkingZoneDialog },
    { name: 'CameraManagement', component: CameraManagementDialogNew },
    { name: 'RfidManager', component: RfidManagerDialogNew },
    { name: 'PricingPolicy', component: PricingPolicyDialog },
    { name: 'GateManagement', component: GateManagementDialog }
  ];

  const handleClose = () => setActiveDialog(null);
  const handleSave = () => console.log('Save called');

  return (
    <div>
      <h1>Dialog Components Test</h1>
      <div style={{ display: 'flex', gap: '10px', marginBottom: '20px' }}>
        {dialogs.map(dialog => (
          <button 
            key={dialog.name}
            onClick={() => setActiveDialog(dialog.name)}
            style={{
              padding: '10px 20px',
              backgroundColor: activeDialog === dialog.name ? '#007bff' : '#6c757d',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            {dialog.name}
          </button>
        ))}
      </div>

      {/* Render active dialog */}
      {activeDialog && (() => {
        const DialogComponent = dialogs.find(d => d.name === activeDialog)?.component;
        return DialogComponent ? (
          <DialogComponent onClose={handleClose} onSave={handleSave} />
        ) : null;
      })()}
    </div>
  );
};

export default DialogTester;
