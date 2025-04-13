#!/bin/bash

# 📦 1. Actualizar el sistema
echo "🔄 Actualizando el sistema..."
sudo apt-get update -y && sudo apt-get upgrade -y

# 📦 2. Instalar dependencias del backend
echo "📂 Instalando dependencias de backend (Laravel)..."
cd backend_oc
composer install
cd ..

# 📦 3. Instalar dependencias del frontend
echo "📂 Instalando dependencias de frontend (Vue)..."
cd frontend_oc
npm install
cd ..

# 📌 4. Crear alias permanentes (rutas absolutas)
if ! grep -q "alias run_back=" ~/.bashrc; then
  echo "alias run_back='cd /workspaces/oneclick-games/backend_oc && php artisan serve --host=0.0.0.0 --port=8000'" >> ~/.bashrc
fi

if ! grep -q "alias run_front=" ~/.bashrc; then
  echo "alias run_front='cd /workspaces/oneclick-games/frontend_oc && npm run dev'" >> ~/.bashrc
fi

# 💡 5. Cargar alias para esta sesión
source ~/.bashrc

# ✅ 6. Mensaje final
echo ""
echo "✅ Proyecto preparado correctamente."
echo ""
echo "Comandos disponibles:"
echo " - run_back  → Levanta el servidor Laravel (backend)"
echo " - run_front → Levanta el servidor Vue (frontend)"
