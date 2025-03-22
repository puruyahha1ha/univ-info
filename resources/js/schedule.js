document.addEventListener('DOMContentLoaded', function () {
    // AlpineJS用拡張関数
    window.scheduleHelpers = {
        // 学習方法の説明を取得する
        getLearningMethodDescription(method) {
            const descriptions = {
                'pomodoro': 'ポモドーロテクニック: 25分の集中作業と5分の休憩を繰り返す方法です。4セット終了後に長めの休憩を取ります。',
                'spaced_repetition': '反復学習: 一定の間隔をあけて繰り返し学習する方法です。記憶の定着に効果的です。',
                'intensive': '短期集中学習: 短期間に集中して学習する方法です。試験直前の詰め込み学習に適しています。',
                'output_focused': 'アウトプット中心学習: 学んだ内容を自分の言葉で説明したり問題を解いたりする方法です。理解度を深めるのに効果的です。'
            };

            return descriptions[method] || '';
        },

        // 繰り返しタイプの日本語名を取得する
        getRepeatTypeName(type) {
            const types = {
                'none': '繰り返しなし',
                'daily': '毎日',
                'weekly': '毎週',
                'monthly': '毎月'
            };

            return types[type] || '不明';
        },

        // 通知時間の表示形式を取得する
        getNotificationDisplay(minutes) {
            if (!minutes) return '通知なし';

            if (minutes >= 1440) {
                const days = Math.floor(minutes / 1440);
                return `${days}日前`;
            }

            if (minutes >= 60) {
                const hours = Math.floor(minutes / 60);
                return `${hours}時間前`;
            }

            return `${minutes}分前`;
        },

        // 日付をフォーマットする
        formatDate(dateString, format = 'YYYY年MM月DD日') {
            const date = new Date(dateString);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();

            return format
                .replace('YYYY', year)
                .replace('MM', month.toString().padStart(2, '0'))
                .replace('DD', day.toString().padStart(2, '0'));
        },

        // 時間をフォーマットする
        formatTime(dateString) {
            const date = new Date(dateString);
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');

            return `${hours}:${minutes}`;
        },

        // GoogleカレンダーのURL生成
        generateGoogleCalendarUrl(event) {
            const startDate = new Date(event.start);
            const endDate = new Date(event.end);

            const startDateFormatted = startDate.toISOString().replace(/-|:|\.\d+/g, '');
            const endDateFormatted = endDate.toISOString().replace(/-|:|\.\d+/g, '');

            let url = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
            url += `&text=${encodeURIComponent(event.title)}`;
            url += `&dates=${startDateFormatted}/${endDateFormatted}`;

            if (event.content) {
                url += `&details=${encodeURIComponent(event.content)}`;
            }

            return url;
        },

        // 学習方法に基づいた推奨時間を計算する
        getRecommendedDuration(method) {
            switch (method) {
                case 'pomodoro':
                    return 25; // 25分
                case 'intensive':
                    return 90; // 90分
                case 'spaced_repetition':
                    return 60; // 60分
                case 'output_focused':
                    return 45; // 45分
                default:
                    return 60; // デフォルト60分
            }
        }
    };

    // ドラッグ&ドロップ機能
    // 注: この機能はビューファイルでLivewireとの連携が必要
    function initDragAndDrop() {
        const draggableEvents = document.querySelectorAll('.event[draggable="true"]');

        draggableEvents.forEach(event => {
            event.addEventListener('dragstart', function (e) {
                e.dataTransfer.setData('text/plain', event.getAttribute('data-event-id'));
                event.classList.add('dragging');
            });

            event.addEventListener('dragend', function () {
                event.classList.remove('dragging');
            });
        });

        const dropZones = document.querySelectorAll('.calendar-day, .time-slot');

        dropZones.forEach(zone => {
            zone.addEventListener('dragover', function (e) {
                e.preventDefault();
                zone.classList.add('drag-over');
            });

            zone.addEventListener('dragleave', function () {
                zone.classList.remove('drag-over');
            });

            zone.addEventListener('drop', function (e) {
                e.preventDefault();
                zone.classList.remove('drag-over');

                const eventId = e.dataTransfer.getData('text/plain');
                const dateAttribute = zone.getAttribute('data-date');
                const timeAttribute = zone.getAttribute('data-time');

                if (dateAttribute && window.Livewire) {
                    // Livewireメソッド呼び出し（moveEvent メソッドが必要）
                    window.Livewire.find(zone.closest('[wire\\:id]').getAttribute('wire:id'))
                        .call('moveEvent', eventId, dateAttribute, timeAttribute);
                }
            });
        });
    }

    // Livewireのイベントを監視して、DOMが更新されたらドラッグ&ドロップを再初期化
    document.addEventListener('livewire:load', function () {
        if (window.Livewire) {
            window.Livewire.hook('message.processed', () => {
                initDragAndDrop();
            });
        }

        // 初期化
        initDragAndDrop();
    });

    // モバイル用のスワイプナビゲーション
    const calendarEl = document.querySelector('.calendar-container');
    if (calendarEl) {
        let touchStartX = 0;
        let touchEndX = 0;

        calendarEl.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        calendarEl.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const MIN_SWIPE_DISTANCE = 50;
            const swipeDistance = touchEndX - touchStartX;

            if (Math.abs(swipeDistance) > MIN_SWIPE_DISTANCE) {
                // Livewireコンポーネントを取得
                const component = window.Livewire.find(calendarEl.closest('[wire\\:id]').getAttribute('wire:id'));

                if (swipeDistance > 0) {
                    // 右スワイプ - 前の期間へ
                    component.call('prevPeriod');
                } else {
                    // 左スワイプ - 次の期間へ
                    component.call('nextPeriod');
                }
            }
        }
    }
});