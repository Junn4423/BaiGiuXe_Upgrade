"""
UI Component Import File
This file imports the new modular UI components from the ui/ directory.
The original UI code has been backed up to ui_backup.py
"""

# Import the main UI class from the new modular structure
from ui.main_ui import GiaoDienQuanLyBaiXe

# Export the main class
__all__ = ['GiaoDienQuanLyBaiXe']

def on_config_saved(self, config_data):
        """Called when work config is saved"""
        # Get selected zone info
        zone_info = config_data.get_selected_zone()
        
        # Update camera component with zone info
        if hasattr(self, "camera_component"):
            self.camera_component.update_zone_info(zone_info)