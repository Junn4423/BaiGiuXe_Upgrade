import torch
import torch.nn as nn
import sys
sys.path.append('Silent-Face-Anti-Spoofing/src/model_lib')
from MiniFASNet import MiniFASNetV2

# Load model
model = MiniFASNetV2()
state_dict = torch.load('Silent-Face-Anti-Spoofing/resources/anti_spoof_models/2.7_80x80_MiniFASNetV2.pth', map_location='cpu')
# Remove 'module.' prefix if present
new_state_dict = {k.replace('module.', ''): v for k, v in state_dict.items()}
model.load_state_dict(new_state_dict)
model.eval()

# Dummy input
dummy = torch.randn(1, 3, 80, 80)

# Export to ONNX
onnx_path = 'models/2.7_80x80_MiniFASNetV2.onnx'
torch.onnx.export(
    model, dummy, onnx_path,
    input_names=['input'],
    output_names=['output'],
    opset_version=11,
    do_constant_folding=True
)
print(f'Exported to {onnx_path}') 